<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .contact-header {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .contact-title {
            color: #e8c547;
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 15px;
            font-family: 'Playfair Display', serif;
        }
        
        .contact-subtitle {
            color: #bdc3c7;
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        
        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: start;
        }
        
        .contact-info {
            background: #23272f;
            padding: 40px;
            border-radius: 15px;
            color: white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }
        
        .contact-info h3 {
            color: #e8c547;
            font-size: 1.5em;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding: 15px;
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .contact-item:hover {
            background: rgba(232, 197, 71, 0.1);
            transform: translateX(5px);
        }
        
        .contact-item i {
            color: #e8c547;
            font-size: 1.5em;
            margin-right: 15px;
            width: 30px;
            text-align: center;
        }
        
        .contact-item-content h4 {
            color: #e8c547;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .contact-item-content p {
            color: #bdc3c7;
            margin: 0;
            line-height: 1.4;
        }
        
        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #23272f;
            font-weight: 600;
            font-size: 0.95em;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #e8c547;
            box-shadow: 0 0 0 3px rgba(232, 197, 71, 0.1);
        }
        
        .form-group textarea {
            height: 120px;
            resize: vertical;
        }
        
        .submit-btn {
            background: #e8c547;
            color: #23272f;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }
        
        .submit-btn:hover {
            background: #d4b03a;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(232, 197, 71, 0.3);
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: #e8c547;
            color: #23272f;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 1.2em;
        }
        
        .social-link:hover {
            background: #d4b03a;
            transform: translateY(-3px);
            color: #23272f;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .contact-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .contact-title {
                font-size: 2em;
            }
            
            .contact-info,
            .contact-form {
                padding: 25px;
            }
        }
    </style>
</head>
<body class="elite-chess-theme">
    <div class="elite-background">
        <div class="wood-pattern"></div>
        <div class="elite-overlay"></div>
        <div class="club-elements">
            <div class="trophy-element">🏆</div>
            <div class="medal-element">🥇</div>
            <div class="chess-piece king">♔</div>
            <div class="chess-piece queen">♕</div>
            <div class="chess-piece rook">♖</div>
            <div class="chess-piece bishop">♗</div>
            <div class="chess-piece knight">♘</div>
            <div class="chess-piece pawn">♙</div>
        </div>
    </div>

    <?= view('partials/navbar') ?>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <div class="contact-container">
        <div class="contact-header">
            <h1 class="contact-title">♖ Contact Us ♗</h1>
            <p class="contact-subtitle">Get in touch with the Elite Chess Club team</p>
        </div>
        
        <div class="contact-content">
            <div class="contact-info">
                <h3><i class="fas fa-info-circle"></i> Get In Touch</h3>
                
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="contact-item-content">
                        <h4>Address</h4>
                        <p>123 Chess Avenue<br>Strategic District<br>Kuala Lumpur, Malaysia</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div class="contact-item-content">
                        <h4>Phone</h4>
                        <p>+60 3-1234 5678<br>+60 12-345 6789</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div class="contact-item-content">
                        <h4>Email</h4>
                        <p>info@elitechessclub.com<br>support@elitechessclub.com</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <div class="contact-item-content">
                        <h4>Opening Hours</h4>
                        <p>Monday - Friday: 9:00 AM - 10:00 PM<br>Saturday - Sunday: 10:00 AM - 11:00 PM</p>
                    </div>
                </div>
                
                <div class="social-links">
                    <a href="#" class="social-link" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <div class="contact-form">
                <h3 style="color: #23272f; margin-bottom: 25px; font-size: 1.5em;">
                    <i class="fas fa-paper-plane"></i> Send us a Message
                </h3>
                
                <form method="POST" action="<?= base_url('contact/send') ?>">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required placeholder="Enter your full name">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required placeholder="Enter your email address">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Membership">Membership</option>
                            <option value="Events">Events & Tournaments</option>
                            <option value="Training">Training & Lessons</option>
                            <option value="Merchandise">Merchandise</option>
                            <option value="Technical Support">Technical Support</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" required placeholder="Tell us how we can help you..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 