import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.169.0/build/three.module.js';

const canvas = document.querySelector('#hero-canvas');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const finePointer = window.matchMedia('(pointer: fine)').matches;

try {
  if (canvas && !reducedMotion) {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(38, 1, 0.1, 100);
    camera.position.set(0, 0, 8.8);
    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 1.7));
    renderer.setClearColor(0x000000, 0);
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.15;

    scene.add(new THREE.AmbientLight(0xffffff, 1.35));
    const key = new THREE.PointLight(0xff8750, 75, 18);
    key.position.set(3.5, 3.2, 4);
    scene.add(key);
    const cool = new THREE.PointLight(0x7899ff, 32, 15);
    cool.position.set(-4, -2, 2);
    scene.add(cool);

    const sculpture = new THREE.Group();
    scene.add(sculpture);
    const core = new THREE.Mesh(
      new THREE.IcosahedronGeometry(1.12, 2),
      new THREE.MeshPhysicalMaterial({ color:0x222832, metalness:.78, roughness:.22, clearcoat:1, clearcoatRoughness:.13, flatShading:true })
    );
    sculpture.add(core);
    const knot = new THREE.Mesh(
      new THREE.TorusKnotGeometry(.92, .19, 180, 18, 2, 5),
      new THREE.MeshPhysicalMaterial({ color:0xf07843, metalness:.66, roughness:.2, clearcoat:1, clearcoatRoughness:.1 })
    );
    knot.rotation.set(.4,.25,-.3);
    sculpture.add(knot);
    const ringA = new THREE.Mesh(new THREE.TorusGeometry(1.7,.018,12,180),new THREE.MeshStandardMaterial({color:0xd9e1ee,metalness:.92,roughness:.25}));
    ringA.rotation.set(1.12,.35,.3);
    sculpture.add(ringA);
    const ringB = new THREE.Mesh(new THREE.TorusGeometry(2.02,.012,10,180),new THREE.MeshStandardMaterial({color:0xf18b5b,metalness:.8,roughness:.25}));
    ringB.rotation.set(.25,1.05,-.5);
    sculpture.add(ringB);

    const accents = new THREE.Group();
    const cubeGeo = new THREE.BoxGeometry(.26,.26,.26);
    const cubeMat = new THREE.MeshPhysicalMaterial({color:0xe7e9ee,metalness:.55,roughness:.18,clearcoat:1});
    for(let i=0;i<9;i++){
      const cube=new THREE.Mesh(cubeGeo,cubeMat);
      const angle=(i/9)*Math.PI*2;
      const radius=2.35+(i%3)*.16;
      cube.position.set(Math.cos(angle)*radius,Math.sin(angle)*radius*.72,(i%3-1)*.25);
      cube.rotation.set(angle*.4,angle,angle*.7);
      accents.add(cube);
    }
    sculpture.add(accents);

    const positions=new Float32Array(420*3);
    for(let i=0;i<420;i++){
      const radius=2.4+Math.random()*2.3,theta=Math.random()*Math.PI*2,phi=Math.acos(2*Math.random()-1);
      positions[i*3]=radius*Math.sin(phi)*Math.cos(theta);
      positions[i*3+1]=radius*Math.sin(phi)*Math.sin(theta);
      positions[i*3+2]=radius*Math.cos(phi);
    }
    const particleGeometry=new THREE.BufferGeometry();
    particleGeometry.setAttribute('position',new THREE.BufferAttribute(positions,3));
    const particles=new THREE.Points(particleGeometry,new THREE.PointsMaterial({color:0xf4a27d,size:.018,transparent:true,opacity:.68}));
    scene.add(particles);

    let pointerX=0,pointerY=0,targetX=0,targetY=0,frame=0,running=false;
    if(finePointer){
      canvas.addEventListener('pointermove',event=>{
        const rect=canvas.getBoundingClientRect();
        targetX=((event.clientX-rect.left)/rect.width-.5)*.45;
        targetY=((event.clientY-rect.top)/rect.height-.5)*.3;
      },{passive:true});
      canvas.addEventListener('pointerleave',()=>{targetX=0;targetY=0;},{passive:true});
    }
    function resize(){
      const width=canvas.clientWidth||1,height=canvas.clientHeight||1;
      renderer.setSize(width,height,false);
      camera.aspect=width/height;
      camera.position.z=width<520?10.3:8.8;
      camera.updateProjectionMatrix();
    }
    resize();
    window.addEventListener('resize',resize,{passive:true});
    function animate(){
      if(document.hidden){running=false;return;}
      running=true;
      frame++;
      pointerX+=(targetX-pointerX)*.035;
      pointerY+=(targetY-pointerY)*.035;
      sculpture.rotation.y=frame*.0028+pointerX;
      sculpture.rotation.x=Math.sin(frame*.004)*.12+pointerY;
      knot.rotation.z=Math.sin(frame*.003)*.18;
      ringA.rotation.z+=.0011;
      ringB.rotation.x-=.0008;
      accents.rotation.y-=.001;
      particles.rotation.y+=.00018;
      renderer.render(scene,camera);
      requestAnimationFrame(animate);
    }
    document.addEventListener('visibilitychange',()=>{if(!document.hidden&&!running)animate();});
    animate();
  } else if(canvas) {
    canvas.setAttribute('aria-hidden','true');
    canvas.style.opacity='.45';
  }
} catch(error) {
  console.warn('The 3D hero could not be initialised; the rest of the portfolio remains available.',error);
}

if('IntersectionObserver' in window){
  const observer=new IntersectionObserver(entries=>{
    entries.forEach(entry=>{
      if(entry.isIntersecting){entry.target.classList.add('is-visible');observer.unobserve(entry.target);}
    });
  },{threshold:.12});
  document.querySelectorAll('.reveal').forEach(el=>observer.observe(el));
}else{
  document.querySelectorAll('.reveal').forEach(el=>el.classList.add('is-visible'));
}

const nav=document.querySelector('#mainNav');
document.querySelectorAll('#mainNav a[href^="#"]').forEach(link=>{
  link.addEventListener('click',()=>{
    if(window.bootstrap&&nav){
      const collapse=window.bootstrap.Collapse.getInstance(nav);
      if(collapse)collapse.hide();
    }
  });
});
const year=document.querySelector('[data-year]');
if(year)year.textContent=new Date().getFullYear();
const form=document.querySelector('#project-form');
if(form)form.addEventListener('submit',event=>{
  event.preventDefault();
  const data=new FormData(form);
  const subject=encodeURIComponent('Project enquiry — '+(data.get('service')||'Website project'));
  const body=encodeURIComponent('Name: '+data.get('name')+'\nEmail: '+data.get('email')+'\nService: '+data.get('service')+'\n\nProject details:\n'+data.get('details'));
  window.location.href='mailto:abdulqavidev@gmail.com?subject='+subject+'&body='+body;
});
