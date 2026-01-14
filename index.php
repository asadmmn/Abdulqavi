<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abdul Qavi - Elite Full-Stack Developer</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    * {

      box-sizing: border-box;
    }

    :root {
      --primary: #6366f1;
      --secondary: #8b5cf6;
      --accent: #f59e0b;
      --success: #10b981;
      --dark: #0f172a;
      --dark-soft: #1e293b;
      --light: #f1f5f9;
      --gray: #64748b;
      --white: #ffffff;
      --text-light: #94a3b8;
      --card-bg: rgba(255, 255, 255, 0.1);
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      line-height: 1.6;
      color: var(--dark);
      overflow-x: hidden;
      background: var(--dark);
    }

    html {
      scroll-behavior: smooth;
    }

    /* Custom Cursor */
    .cursor {
      width: 20px;
      height: 20px;
      border: 2px solid var(--primary);
      border-radius: 50%;
      position: fixed;
      pointer-events: none;
      z-index: 9999;
      transition: all 0.1s ease;
      mix-blend-mode: difference;
    }

    .cursor-trail {
      width: 8px;
      height: 8px;
      background: var(--primary);
      border-radius: 50%;
      position: fixed;
      pointer-events: none;
      z-index: 9998;
      transition: all 0.2s ease;
      opacity: 0.7;
    }

    /* Enhanced Navigation */
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      background: rgba(15, 23, 42, 0.95);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      padding: 1rem 0;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 800;
      color: var(--white);
      text-decoration: none;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .nav-menu {
      display: flex;
      list-style: none;
      gap: 2.5rem;
    }

    .nav-link {
      color: var(--text-light);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
      padding: 0.5rem 0;
    }

    .nav-link:hover {
      color: var(--white);
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      border-radius: 2px;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
      width: 100%;
    }

    /* Particle System */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }

    .particle {
      position: absolute;
      width: 2px;
      height: 2px;
      background: var(--primary);
      border-radius: 50%;
      animation: float-particles 8s linear infinite;
      opacity: 0.6;
    }

    /* Enhanced Hero Section */
    .hero {
     
		
      display: flex;
      align-items: center;
      background: linear-gradient(135deg, var(--dark) 0%, var(--dark-soft) 50%, #334155 100%);
      position: relative;
      overflow: hidden;
    }

    .hero-bg {
      position: absolute;
	    margin-top: 60px;     
 margin-bottom: 60px;   
    
      left: 0;
      right: 0;
    
      background: 
        radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(245, 158, 11, 0.2) 0%, transparent 50%);
    }

    .hero-content {
      max-width: 1400px;
          margin-top: 60px;     
 margin-bottom: 60px;  
      padding: 0 2rem;
      position: relative;
      z-index: 2;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .hero-text {
      max-width: 600px;
    }

    .hero-subtitle {
      font-size: 1.4rem;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 700;
      margin-bottom: 1.5rem;
      opacity: 0;
      animation: slideUp 0.8s ease forwards 0.3s;
    }

    .hero-title {
      font-size: clamp(3rem, 6vw, 5rem);
	  
      font-weight: 900;
      color: var(--white);
      margin-bottom: 2rem;
      line-height: 1;
      opacity: 0;
      animation: slideUp 0.8s ease forwards 0.5s;
    }

    .hero-title .highlight {
      background: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: gradient-shift 3s ease-in-out infinite;
    }

    .hero-description {
      font-size: 1.3rem;
      color: var(--text-light);
      margin-bottom: 3rem;
      line-height: 1.7;
      opacity: 0;
      animation: slideUp 0.8s ease forwards 0.7s;
    }

    .hero-buttons {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
      opacity: 0;
      animation: slideUp 0.8s ease forwards 0.9s;
    }

    .hero-visual {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .code-window {
      background: rgba(15, 23, 42, 0.9);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      padding: 2rem;
      backdrop-filter: blur(20px);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
      opacity: 0;
      animation: slideUp 0.8s ease forwards 1.1s;
      transform: perspective(1000px) rotateY(-15deg);
      transition: transform 0.3s ease;
    }

    .code-window:hover {
      transform: perspective(1000px) rotateY(0deg);
    }

    .code-header {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .code-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
    }

    .code-dot.red { background: #ef4444; }
    .code-dot.yellow { background: #f59e0b; }
    .code-dot.green { background: #10b981; }

    .code-content {
      font-family: 'Monaco', 'Menlo', monospace;
      font-size: 0.9rem;
      line-height: 1.6;
    }

    .code-line {
      display: block;
      margin-bottom: 0.5rem;
      opacity: 0;
      animation: typewriter 0.1s ease forwards;
    }

    .code-line:nth-child(1) { animation-delay: 1.5s; color: #8b5cf6; }
    .code-line:nth-child(2) { animation-delay: 1.7s; color: #06b6d4; }
    .code-line:nth-child(3) { animation-delay: 1.9s; color: #10b981; }
    .code-line:nth-child(4) { animation-delay: 2.1s; color: #f59e0b; }
    .code-line:nth-child(5) { animation-delay: 2.3s; color: #ef4444; }

    .floating-elements {
      position: absolute;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }

    .floating-element {
      position: absolute;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 20px;
      opacity: 0.1;
      animation: float-complex 8s ease-in-out infinite;
    }

    .floating-element:nth-child(1) {
      width: 100px;
      height: 100px;
      top: 10%;
      right: 10%;
      animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
      width: 150px;
      height: 150px;
      bottom: 20%;
      right: 30%;
      animation-delay: 2s;
      border-radius: 50%;
    }

    .floating-element:nth-child(3) {
      width: 80px;
      height: 80px;
      top: 60%;
      left: 10%;
      animation-delay: 4s;
      transform: rotate(45deg);
    }

    /* Enhanced Buttons */
    .btn {
      padding: 1.2rem 2.5rem;
      border: none;
      border-radius: 60px;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.7rem;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
      position: relative;
      overflow: hidden;
      font-size: 1rem;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.6s ease;
    }

    .btn:hover::before {
      left: 100%;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: var(--white);
      box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
      border: 2px solid transparent;
    }

    .btn-primary:hover {
      transform: translateY(-5px);
      box-shadow: 0 25px 50px rgba(99, 102, 241, 0.6);
      color: var(--white);
    }

    .btn-secondary {
      background: transparent;
      color: var(--white);
      border: 2px solid rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(20px);
    }

    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: var(--primary);
      color: var(--white);
      transform: translateY(-5px);
    }

    /* Enhanced About Section */
    .about {
      padding: 8rem 0;
      background: linear-gradient(180deg, var(--dark) 0%, var(--dark-soft) 100%);
      position: relative;
    }

    .about::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--primary), transparent);
    }

    .container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .section-title {
      font-size: clamp(2.5rem, 4vw, 4rem);
      font-weight: 800;
      text-align: center;
      margin-bottom: 4rem;
      position: relative;
      color: var(--white);
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -20px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 2px;
    }

    .about-content {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      gap: 6rem;
      align-items: center;
    }

    .about-image {
      position: relative;
    }

    .profile-container {
      position: relative;
      width: 100%;
      max-width: 400px;
      margin: 0 auto;
    }

    .profile-container::before {
      content: '';
      position: absolute;
      top: -30px;
      left: -30px;
      right: 30px;
      bottom: 30px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 30px;
      z-index: -1;
      animation: pulse-glow 2s ease-in-out infinite alternate;
    }

    .profile-img {
      width: 100%;
      height: 450px;
      background: linear-gradient(135deg, #1e293b, #334155);
      border-radius: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--text-light);
      font-size: 5rem;
      position: relative;
      overflow: hidden;
      border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .about-text h3 {
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
      color: var(--white);
      font-weight: 800;
    }

    .about-text p {
      color: var(--text-light);
      margin-bottom: 2rem;
      font-size: 1.2rem;
      line-height: 1.8;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin: 3rem 0;
    }

    .stat-item {
      text-align: center;
      padding: 2rem;
      background: var(--card-bg);
      border-radius: 20px;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: transform 0.3s ease;
    }

    .stat-item:hover {
      transform: translateY(-5px);
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .stat-label {
      color: var(--text-light);
      font-weight: 600;
      margin-top: 0.5rem;
    }

    .skills-section {
      margin-top: 4rem;
    }

    .skills-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .skill-item {
      background: var(--card-bg);
      padding: 2rem 1.5rem;
      border-radius: 20px;
      text-align: center;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
    }

    .skill-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.1), transparent);
      transition: left 0.6s ease;
    }

    .skill-item:hover::before {
      left: 100%;
    }

    .skill-item:hover {
      transform: translateY(-10px);
      border-color: var(--primary);
    }

    .skill-icon {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 1rem;
    }

    .skill-name {
      color: var(--white);
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .skill-level {
      color: var(--text-light);
      font-size: 0.9rem;
    }

    /* Enhanced Projects Section */
    .projects {
      padding: 8rem 0;
      background: var(--dark-soft);
      position: relative;
    }

    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 3rem;
      margin-top: 4rem;
    }

    .project-card {
      background: var(--card-bg);
      border-radius: 25px;
      overflow: hidden;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      group: hover;
    }

    .project-card:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
      border-color: var(--primary);
    }

    .project-image {
      height: 250px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-size: 4rem;
      overflow: hidden;
    }

    .project-image::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.2);
      transition: opacity 0.3s ease;
    }

    .project-card:hover .project-image::before {
      opacity: 0;
    }

    .project-content {
      padding: 2.5rem;
    }

    .project-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: var(--white);
    }

    .project-description {
      color: var(--text-light);
      margin-bottom: 2rem;
      line-height: 1.7;
    }

    .project-tech {
      display: flex;
      flex-wrap: wrap;
      gap: 0.8rem;
      margin-bottom: 2rem;
    }

    .tech-tag {
      background: rgba(99, 102, 241, 0.2);
      color: var(--primary);
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      border: 1px solid rgba(99, 102, 241, 0.3);
      transition: all 0.3s ease;
    }

    .tech-tag:hover {
      background: var(--primary);
      color: var(--white);
      transform: translateY(-2px);
    }

    .project-links {
      display: flex;
      gap: 1.5rem;
    }

    .project-link {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.3s ease;
      padding: 0.5rem 1rem;
      border-radius: 10px;
      background: rgba(99, 102, 241, 0.1);
    }

    .project-link:hover {
      color: var(--white);
      background: var(--primary);
      transform: translateX(5px);
    }

    /* Enhanced Contact Section */
    .contact {
      padding: 8rem 0;
      background: linear-gradient(135deg, var(--dark) 0%, var(--dark-soft) 100%);
      color: var(--white);
      position: relative;
    }

    .contact-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 6rem;
      align-items: start;
    }

    .contact-info h3 {
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
      font-weight: 800;
    }

    .contact-info p {
      color: var(--text-light);
      margin-bottom: 3rem;
      font-size: 1.2rem;
      line-height: 1.8;
    }

    .contact-methods {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .contact-method {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      color: var(--white);
      text-decoration: none;
      padding: 1.5rem;
      background: var(--card-bg);
      border-radius: 20px;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.4s ease;
    }

    .contact-method:hover {
      color: var(--white);
      transform: translateX(10px);
      border-color: var(--primary);
    }

    .contact-method i {
      width: 25px;
      text-align: center;
      font-size: 1.2rem;
      color: var(--primary);
    }

    .contact-form {
      background: var(--card-bg);
      padding: 3rem;
      border-radius: 25px;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .form-group {
      margin-bottom: 2rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.8rem;
      font-weight: 600;
      color: var(--white);
    }

    .form-control {
      width: 100%;
      padding: 1.2rem;
      border: 2px solid rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      background: rgba(255, 255, 255, 0.05);
      color: var(--white);
      font-size: 1rem;
      transition: all 0.3s ease;
      font-family: inherit;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      background: rgba(255, 255, 255, 0.1);
    }

    .form-control::placeholder {
      color: var(--text-light);
    }

    textarea.form-control {
      height: 140px;
      resize: vertical;
    }

    /* Enhanced Footer */
    .footer {
      background: #020617;
      color: var(--white);
      text-align: center;
      padding: 4rem 0 2rem;
      position: relative;
    }

    .footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--primary), transparent);
    }

    .social-links {
      display: flex;
      justify-content: center;
      gap: 2rem;
      margin-bottom: 2rem;
    }

    .social-link {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: var(--card-bg);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      text-decoration: none;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 2px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
    }

    .social-link:hover {
      background: var(--primary);
      transform: translateY(-5px) scale(1.1);
      color: var(--white);
      border-color: var(--primary);
      box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
    }

    .footer-text {
      color: var(--text-light);
      margin-top: 2rem;
      font-size: 1.1rem;
    }

    /* Scroll Progress */
    .scroll-indicator {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: rgba(255, 255, 255, 0.1);
      z-index: 9999;
    }

    .scroll-progress {
      height: 100%;
      background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
      width: 0%;
      transition: width 0.1s ease;
      border-radius: 0 2px 2px 0;
    }

    /* Animations */
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes float-complex {
      0%, 100% {
        transform: translateY(0) rotate(0deg) scale(1);
      }
      25% {
        transform: translateY(-20px) rotate(90deg) scale(1.1);
      }
      50% {
        transform: translateY(-10px) rotate(180deg) scale(0.9);
      }
      75% {
        transform: translateY(-30px) rotate(270deg) scale(1.1);
      }
    }

    @keyframes float-particles {
      0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
      }
      10%, 90% {
        opacity: 0.6;
      }
      100% {
        transform: translateY(-100px) rotate(360deg);
        opacity: 0;
      }
    }

    @keyframes pulse-glow {
      0% {
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
      }
      100% {
        box-shadow: 0 0 40px rgba(99, 102, 241, 0.6);
      }
    }

    @keyframes gradient-shift {
      0%, 100% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
    }

    @keyframes typewriter {
      from {
        opacity: 0;
        transform: translateX(-10px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Mobile Responsiveness */
    @media (max-width: 1024px) {
      .hero-content,
      .about-content,
      .contact-content {
        grid-template-columns: 1fr;
        gap: 3rem;
      }

      .code-window {
        transform: none;
        margin-top: 2rem;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }

      .skills-grid {
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      }
    }

    @media (max-width: 768px) {
      .cursor,
      .cursor-trail {
        display: none;
      }

      .nav-menu {
        display: none;
      }

      .hero-title {
        font-size: 2.5rem;
      }

      .hero-buttons {
        flex-direction: column;
        align-items: stretch;
      }

      .projects-grid {
        grid-template-columns: 1fr;
      }

      .container {
        padding: 0 1rem;
      }

      .section-title {
        font-size: 2.5rem;
      }

      .social-links {
        gap: 1rem;
      }

      .social-link {
        width: 50px;
        height: 50px;
      }
    }

    /* Loading Animation */
    .loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: var(--dark);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10000;
      opacity: 1;
      transition: opacity 0.5s ease;
    }

    .loading-overlay.hidden {
      opacity: 0;
      pointer-events: none;
    }

    .loading-spinner {
      width: 60px;
      height: 60px;
      border: 3px solid rgba(99, 102, 241, 0.3);
      border-top: 3px solid var(--primary);
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <!-- Loading Overlay -->
  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>

  <!-- Custom Cursor -->
  <div class="cursor" id="cursor"></div>
  <div class="cursor-trail" id="cursorTrail"></div>

  <!-- Particles -->
  <div class="particles" id="particles"></div>

  <!-- Scroll Indicator -->
  <div class="scroll-indicator">
    <div class="scroll-progress" id="scrollProgress"></div>
  </div>

  <!-- Navigation -->
  <nav class="navbar">
    <div class="nav-container">
      <a href="#" class="logo">Abdul Qavi</a>
      <ul class="nav-menu">
        <li><a href="#home" class="nav-link active">Home</a></li>
        <li><a href="#about" class="nav-link">About</a></li>
        <li><a href="#projects" class="nav-link">Projects</a></li>
        <li><a href="#contact" class="nav-link">Contact</a></li>
      </ul>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="home" class="hero mt-4">
    <div class="hero-bg"></div>
    <div class="floating-elements">
      <div class="floating-element"></div>
      <div class="floating-element"></div>
      <div class="floating-element"></div>
    </div>
    <div class="hero-content">
      <div class="hero-text">
        <h1 class="hero-title">
          Building <span class="highlight">Digital Excellence</span> with Code
        </h1>
        <p class="hero-description">
          Crafting cutting-edge web applications with Laravel & Vue.js. 
          Transforming ideas into powerful digital experiences that drive results and captivate users.
        </p>
        <div class="hero-buttons">
          <a href="#projects" class="btn btn-primary">
            <i class="fas fa-rocket"></i>
            Explore My Work
          </a>
          <a href="#contact" class="btn btn-secondary">
            <i class="fas fa-coffee"></i>
            Let's Collaborate
          </a>
        </div>
      </div>
      <div class="hero-visual">
        <div class="code-window">
          <div class="code-header">
            <div class="code-dot red"></div>
            <div class="code-dot yellow"></div>
            <div class="code-dot green"></div>
          </div>
          <div class="code-content">
            <span class="code-line">&lt;?php namespace App\Http\Controllers;</span>
            <span class="code-line">class ProjectController extends Controller</span>
            <span class="code-line">{</span>
            <span class="code-line">    public function create() { /* Magic happens */ }</span>
            <span class="code-line">}</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="about">
    <div class="container">
      <h2 class="section-title">About Me</h2>
      <div class="about-content">
        <div class="about-image">
          <div class="profile-container">
            <div class="profile-img">
			
			<img src="assets/images/profile.jfif">
			
              <!--<i class="fas fa-user-tie"></i>-->
            </div>
          </div>
        </div>
        <div class="about-text">
          <h3>Passionate Developer & Problem Solver</h3>
          <p>
            With 3+ years of experience in full-stack development, I specialize in creating 
            scalable web applications that deliver exceptional user experiences. My expertise 
            spans from backend architecture with Laravel to dynamic frontends with Vue.js.
          </p>
          <p>
            I'm passionate about clean code, modern development practices, and staying at the 
            forefront of technology. Every project is an opportunity to learn something new 
            and create something amazing.
          </p>

          <div class="stats-grid">
            <div class="stat-item">
              <div class="stat-number">50+</div>
              <div class="stat-label">Projects Completed</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">3+</div>
              <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">25+</div>
              <div class="stat-label">Happy Clients</div>
            </div>
          </div>

          <div class="skills-section">
            <div class="skills-grid">
              <div class="skill-item">
                <div class="skill-icon"><i class="fab fa-laravel"></i></div>
                <div class="skill-name">Laravel</div>
                <div class="skill-level">Expert</div>
              </div>
              <div class="skill-item">
                <div class="skill-icon"><i class="fab fa-vuejs"></i></div>
                <div class="skill-name">Vue.js</div>
                <div class="skill-level">Advanced</div>
              </div>
              <div class="skill-item">
                <div class="skill-icon"><i class="fab fa-php"></i></div>
                <div class="skill-name">PHP</div>
                <div class="skill-level">Expert</div>
              </div>
              <div class="skill-item">
                <div class="skill-icon"><i class="fab fa-js"></i></div>
                <div class="skill-name">JavaScript</div>
                <div class="skill-level">Advanced</div>
              </div>
              <div class="skill-item">
                <div class="skill-icon"><i class="fas fa-database"></i></div>
                <div class="skill-name">MySQL</div>
                <div class="skill-level">Advanced</div>
              </div>
              <div class="skill-item">
                <div class="skill-icon"><i class="fab fa-bootstrap"></i></div>
                <div class="skill-name">Bootstrap</div>
                <div class="skill-level">Expert</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Projects Section -->
  <section id="projects" class="projects">
    <div class="container">
      <h2 class="section-title">Featured Projects</h2>
      <div class="projects-grid">
        <div class="project-card">
          <div class="project-image">
            <i class="fas fa-book-open"></i>
          </div>
          <div class="project-content">
            <h3 class="project-title">Premium Online Bookstore</h3>
            <p class="project-description">
              A sophisticated e-commerce platform featuring advanced search, user reviews, 
              wishlist functionality, and seamless Stripe payment integration. Built with 
              modern Laravel architecture and responsive Vue.js components.
            </p>
            <div class="project-tech">
              <span class="tech-tag">Laravel 10</span>
              <span class="tech-tag">Vue.js 3</span>
              <span class="tech-tag">Stripe API</span>
              <span class="tech-tag">MySQL</span>
              <span class="tech-tag">Redis</span>
            </div>
            <div class="project-links">
              <a href="#" class="project-link">
                <i class="fas fa-external-link-alt"></i>
                Live Demo
              </a>
              <a href="#" class="project-link">
                <i class="fab fa-github"></i>
                Source Code
              </a>
            </div>
          </div>
        </div>

        <div class="project-card">
          <div class="project-image">
            <i class="fas fa-map-marked-alt"></i>
          </div>
          <div class="project-content">
            <h3 class="project-title">Luxury Travel Platform</h3>
            <p class="project-description">
              An immersive travel website with interactive maps, virtual tours, 
              real-time booking system, and integrated payment gateway. Features 
              dynamic content management and multilingual support.
            </p>
            <div class="project-tech">
              <span class="tech-tag">Laravel</span>
              <span class="tech-tag">Vue.js</span>
              <span class="tech-tag">Google Maps API</span>
              <span class="tech-tag">PayPal</span>
              <span class="tech-tag">Tailwind CSS</span>
            </div>
            <div class="project-links">
              <a href="#" class="project-link">
                <i class="fas fa-external-link-alt"></i>
                Live Demo
              </a>
              <a href="#" class="project-link">
                <i class="fab fa-github"></i>
                Source Code
              </a>
            </div>
          </div>
        </div>

        <div class="project-card">
          <div class="project-image">
            <i class="fas fa-handshake"></i>
          </div>
          <div class="project-content">
            <h3 class="project-title">Elite Freelancing Hub</h3>
            <p class="project-description">
              A comprehensive freelancing platform with advanced matching algorithms, 
              real-time chat system, project milestone tracking, and secure escrow 
              payments. Features AI-powered skill matching and reputation system.
            </p>
            <div class="project-tech">
              <span class="tech-tag">Laravel</span>
              <span class="tech-tag">WebSockets</span>
              <span class="tech-tag">Bootstrap 5</span>
              <span class="tech-tag">Pusher</span>
              <span class="tech-tag">Elasticsearch</span>
            </div>
            <div class="project-links">
              <a href="#" class="project-link">
                <i class="fas fa-external-link-alt"></i>
                Live Demo
              </a>
              <a href="#" class="project-link">
                <i class="fab fa-github"></i>
                Source Code
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact">
    <div class="container">
      <h2 class="section-title">Let's Create Something Amazing</h2>
      <div class="contact-content">
        <div class="contact-info">
          <h3>Ready to Start Your Next Project?</h3>
          <p>
            I'm always excited to collaborate on innovative projects and help bring your ideas to life. 
            Whether you need a full-stack web application, API development, or consultation on your 
            current project, let's discuss how we can work together.
          </p>
          <div class="contact-methods">
            <a href="mailto:asadm8975@gmail.com" class="contact-method">
              <i class="fas fa-envelope"></i>
              <div>
                <strong>Email</strong><br>
                asadm8975@gmail.com
              </div>
            </a>
            <a href="#" class="contact-method">
              <i class="fab fa-linkedin"></i>
              <div>
                <strong>LinkedIn</strong><br>
                Connect professionally
              </div>
            </a>
            <a href="#" class="contact-method">
              <i class="fab fa-github"></i>
              <div>
                <strong>GitHub</strong><br>
                View my code
              </div>
            </a>
            <a href="#" class="contact-method">
              <i class="fas fa-phone"></i>
              <div>
                <strong>Schedule a Call</strong><br>
                Let's discuss your project
              </div>
            </a>
          </div>
        </div>
        <?php include 'contact-form.php'; ?>

      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="social-links">
        <a href="#" class="social-link" title="GitHub"><i class="fab fa-github"></i></a>
        <a href="#" class="social-link" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
        <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="mailto:asadm8975@gmail.com" class="social-link" title="Email"><i class="fas fa-envelope"></i></a>
        <a href="#" class="social-link" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
      </div>
      <p class="footer-text">
        &copy; 2025 Abdul Qavi. Crafted with passion, precision, and cutting-edge technology. 
        <br>Building the future, one line of code at a time. 🚀
      </p>
    </div>
  </footer>

  <script>
    // Loading Animation
    window.addEventListener('load', function() {
      setTimeout(() => {
        document.getElementById('loadingOverlay').classList.add('hidden');
      }, 1000);
    });

    // Custom Cursor
    const cursor = document.getElementById('cursor');
    const cursorTrail = document.getElementById('cursorTrail');
    let mouseX = 0, mouseY = 0;
    let trailX = 0, trailY = 0;

    document.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;
    });

    function animateCursor() {
      trailX += (mouseX - trailX) * 0.1;
      trailY += (mouseY - trailY) * 0.1;

      if (cursor) {
        cursor.style.left = mouseX + 'px';
        cursor.style.top = mouseY + 'px';
      }

      if (cursorTrail) {
        cursorTrail.style.left = trailX + 'px';
        cursorTrail.style.top = trailY + 'px';
      }

      requestAnimationFrame(animateCursor);
    }

    if (window.innerWidth > 768) {
      animateCursor();
    }

    // Particle System
    function createParticles() {
      const particlesContainer = document.getElementById('particles');
      const particleCount = 15;

      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 8 + 's';
        particle.style.animationDuration = (8 + Math.random() * 4) + 's';
        particlesContainer.appendChild(particle);
      }
    }

    createParticles();

    // Enhanced Navigation
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section');

    function updateActiveNav() {
      let current = '';
      sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (window.scrollY >= sectionTop - 200) {
          current = section.getAttribute('id');
        }
      });

      navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href').slice(1) === current) {
          link.classList.add('active');
        }
      });
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // Scroll progress indicator
    function updateScrollProgress() {
      const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
      const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrolled = (winScroll / height) * 100;
      document.getElementById('scrollProgress').style.width = scrolled + '%';
    }

    // Enhanced navbar background on scroll
    function updateNavbar() {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 100) {
        navbar.style.background = 'rgba(15, 23, 42, 0.98)';
        navbar.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.3)';
      } else {
        navbar.style.background = 'rgba(15, 23, 42, 0.95)';
        navbar.style.boxShadow = 'none';
      }
    }

    window.addEventListener('scroll', () => {
      updateScrollProgress();
      updateNavbar();
      updateActiveNav();
    });

    // Enhanced form submission
    document.getElementById('contactForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Add loading state
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
      submitBtn.disabled = true;

      // Simulate form submission
      setTimeout(() => {
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Message Sent!';
        submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
        
        setTimeout(() => {
          submitBtn.innerHTML = originalText;
          submitBtn.style.background = '';
          submitBtn.disabled = false;
          this.reset();
          
          // Show success message
          const successMsg = document.createElement('div');
          successMsg.innerHTML = `
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #10b981; padding: 1rem; border-radius: 10px; margin-top: 1rem; text-align: center;">
              <i class="fas fa-check-circle"></i> Thank you! I'll get back to you within 24 hours.
            </div>
          `;
          this.appendChild(successMsg.firstElementChild);
          
          setTimeout(() => {
            const msgEl = this.querySelector('div[style*="background: rgba(16, 185, 129"]');
            if (msgEl) msgEl.remove();
          }, 5000);
        }, 1500);
      }, 2000);
    });

    // Advanced Intersection Observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }, index * 100);
        }
      });
    }, observerOptions);

    // Observe elements for scroll animations
    const animatedElements = document.querySelectorAll(`
      .project-card, .skill-item, .stat-item, .contact-method, 
      .about-text, .profile-container, .contact-form
    `);

    animatedElements.forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
      observer.observe(el);
    });

    // Enhanced hover effects for interactive elements
    const interactiveElements = document.querySelectorAll('.btn, .project-card, .skill-item, .social-link');

    interactiveElements.forEach(el => {
      el.addEventListener('mouseenter', function() {
        if (cursor) cursor.style.transform = 'scale(1.5)';
      });

      el.addEventListener('mouseleave', function() {
        if (cursor) cursor.style.transform = 'scale(1)';
      });
    });

    // Typing effect for hero subtitle
    const subtitle = document.querySelector('.hero-subtitle');
    if (subtitle) {
      const originalText = subtitle.textContent;
      subtitle.textContent = '';
      
      setTimeout(() => {
        let i = 0;
        const typeWriter = () => {
          if (i < originalText.length) {
            subtitle.textContent += originalText.charAt(i);
            i++;
            setTimeout(typeWriter, 100);
          }
        };
        typeWriter();
      }, 1200);
    }
  </script>
</body>
</html>