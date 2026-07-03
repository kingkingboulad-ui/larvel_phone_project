@extends('web.master')

 @section('content')
 <div class="error-container">
     <div class="error-graphic">
         <h1 class="error-code">404</h1>
         <div class="error-glow"></div>
     </div>
     
     <h2 class="error-title">Page Not Found</h2>
     <p class="error-message">Oops! The page you are looking for has been moved, deleted, or never existed in this matrix.</p>
     
     <div class="error-actions">
         <a href="{{ url('/') }}" class="btn-home">
             <i class="bi bi-house-door-fill"></i> Return Home
         </a>
     </div>
 </div>
 
 <!-- التنسيقات المتوافقة مع ثيم موقعك -->
 <style>
     .error-container {
         max-width: 600px;
         margin: 80px auto;
         padding: 40px 20px;
         text-align: center;
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
         direction: ltr;
         background-color: var(--bg-color);
         color: var(--text-color);
         transition: var(--transition);
     }
 
     .error-graphic {
         position: relative;
         display: inline-block;
         margin-bottom: 20px;
     }
 
     .error-code {
         font-size: 8rem;
         font-weight: 900;
         margin: 0;
         line-height: 1;
         color: var(--text-color);
         letter-spacing: -2px;
         /* تأثير نص مضيء خفيف */
         text-shadow: 0 0 20px rgba(0, 255, 135, 0.2); 
     }
 
     /* دائرة التوهج الخلفية المستوحاة من Glow Tech الخاص بموقعك */
     .error-glow {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         width: 150px;
         height: 150px;
         background: var(--primary-color);
         opacity: 0.15;
         filter: blur(50px);
         border-radius: 50%;
         z-index: -1;
     }
 
     .error-title {
         font-size: 2rem;
         font-weight: 700;
         margin-bottom: 15px;
         color: var(--text-color);
     }
 
     .error-message {
         font-size: 1.1rem;
         color: var(--text-muted);
         max-width: 450px;
         margin: 0 auto 35px auto;
         line-height: 1.6;
     }
 
     /* زر العودة للرئيسية المتناسق مع الأزرار الفسفورية في موقعك */
     .btn-home {
         display: inline-flex;
         align-items: center;
         gap: 10px;
         background-color: var(--primary-color);
         color: #ffffff; /* نص أسود للتباين العالي والوضوح فوق الأخضر */
         text-decoration: none;
         padding: 12px 30px;
         border-radius: var(--radius-md);
         font-weight: 600;
         font-size: 1rem;
         transition: var(--transition);
         box-shadow: 0 0 15px rgba(0, 255, 135, 0.2);
     }
 
     .btn-home:hover {
         background-color: var(--primary-hover);
         color: #000000;
         box-shadow: 0 0 25px rgba(0, 255, 135, 0.6);
         transform: translateY(-2px);
     }
 
     /* توافق الشاشات الصغيرة */
     @media (max-width: 576px) {
         .error-container {
             margin: 40px auto;
         }
         .error-code {
             font-size: 6rem;
         }
         .error-title {
             font-size: 1.6rem;
         }
     }
 </style>
 @endsection

