<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Management Inventory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .btn-light-custom {
      background-color: #e6e6e6;
      color: #160a44;
      font-weight: 500;
      border-radius: 50rem;
      padding: 0.375rem 1.25rem;
      font-size: 0.875rem;
      transition: background-color 0.2s ease;
    }
    .btn-light-custom:hover {
      background-color: #d9d9d9;
      color: #160a44;
    }
    .btn-outline-light-custom {
      border-color: #e6e6e6;
      color: #e6e6e6;
      font-weight: 500;
      border-radius: 50rem;
      padding: 0.375rem 1.25rem;
      font-size: 0.875rem;
      transition: background-color 0.2s ease, color 0.2s ease;
    }
    .btn-outline-light-custom:hover {
      background-color: white;
      color: #160a44;
      border-color: white;
    }
    a.nav-link {
      color: white;
      font-size: 0.75rem;
      font-weight: 400;
      padding: 0 0.5rem;
    }
    a.nav-link:hover {
      text-decoration: underline;
      color: white;
    }
    @media (min-width: 768px) {
      a.nav-link {
        font-size: 0.875rem;
      }
    }

    main.features-container {
      max-width: 768px;
      margin: 3rem auto 6rem;
      padding: 0 1rem;
      text-align: center;
    }
    main.features-container h1.title {
      font-weight: 600;
      font-size: 32px;
      margin-bottom: 0.25rem;
    
    }
    main.features-container p.subtitle {
      font-weight: 400;
      font-size: 15px;
      margin-bottom: 3rem;
      line-height: 1.2;
    }
    .feature-row {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      margin-bottom: 4rem;
    }
    @media (min-width: 768px) {
      .feature-row {
        flex-direction: row;
        align-items: center;
        gap: 3rem;
        margin-bottom: 5rem;
      }
      .feature-row.reverse {
        flex-direction: row-reverse;
      }
    }
    .feature-image {
      border-radius: 1rem;
      max-width: 320px;
      width: 100%;
      object-fit: cover;
      box-shadow: 0 0 0 12px #d1d5db33; /* subtle light border */
    }
    .feature-text {
      text-align: left;
      font-size: 20px;
      max-width: 400px;
      flex-shrink: 0;
    }
    .feature-text p.feature-label {
      margin-bottom: 0.25rem;
      font-weight: 400;
      font-size: 25px;
    }
    .feature-text h2.feature-title {
      font-weight: 700;
      font-size: 1rem;
      margin-bottom: 0.5rem;
    }
    .feature-text p.feature-desc {
      margin-bottom: 1rem;
      line-height: 1.2;
    }
    .feature-text ul {
      list-style: none;
      padding-left: 0;
      margin: 0;
      font-size: 15px;
      color: #3b3e44;
    }
    .feature-text ul li {
      display: flex;
      align-items: flex-start;
      gap: 0.25rem;
      margin-bottom: 0.25rem;
    }
    .feature-text ul li svg {
      flex-shrink: 0;
      margin-top: 0.15rem;
      width: 0.5rem;
      height: 0.5rem;
      fill: #9ca3af;
    }

    .icon-circle {
      background-color: #1b0b44;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
    }
    .icon-circle i {
      color: white;
      font-size: 0.875rem;
    }
    .service-card {
      background-color: #f1f1f1;
      border-radius: 0.5rem;
      padding: 1.5rem;
      height: 100%;
    }
    .btn-learn {
      background-color: #1b0b44;
      color: white;
      font-weight: 600;
      border-radius: 50px;
      padding: 0.5rem 3rem;
      border: none;
    }
    .btn-see {
      border: 1px solid #1b0b44;
      color: #1b0b44;
      font-weight: 600;
      border-radius: 50px;
      padding: 0.5rem 2rem;
      background-color: transparent;
    }

    .testimonial-card {
      background-color: #e0e0e0;
      border-radius: 0.5rem;
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }
    .testimonial-text {
      font-size: 0.875rem;
      line-height: 1.5;
      margin-bottom: 1.5rem;
    }
    .quote-icon {
      font-size: 2.5rem;
      font-weight: 900;
    }
    .star-rating i {
      color: #fbbf24;
      font-size: 0.875rem;
      margin-right: 0.1rem;
    }
    .testimonial-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .client-info {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    .client-name {
      font-size: 0.75rem;
      margin: 0;
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
</head>
<body>
  <div style="background-color: #160a44;">
    <header class="container-xl d-flex justify-content-between align-items-center py-3 px-3 px-md-4 text-light">
      <div class="fw-semibold fs-5 ">
        Manage Inventory
      </div>
      <nav class="d-none d-md-flex">
        <a href="#" class="nav-link">Features</a>
        <a href="#" class="nav-link">About</a>
        <a href="#" class="nav-link">Pricing</a>
        <a href="#" class="nav-link">Contact</a>
      </nav>
      <a href="login.php"><button class="btn btn-light-custom d-none d-md-inline-block">Get Started</button></a>
    </header>
  
    <main class="container-xl text-center px-3 px-md-0" style="max-width: 768px;">
      <h1 class="fw-bold lh-base fs-3 fs-sm-4 fs-md-1 text-light" style="line-height: 1.2;">
        Manage inventory effortlessly with our streamlined system. Try now!
      </h1>
      <div class="mt-4 d-flex justify-content-center gap-3">
        <a href="login.php"><button class="btn btn-light-custom">Start Free</button></a>
        <a href="login.php"><button class="btn btn-outline-light-custom">Get Started</button></a>
      </div>
      <div class="mt-5 rounded-3 overflow-hidden">
        <img 
          src="https://storage.googleapis.com/a1aa/image/4a32b009-6b36-4a61-67c8-b223ea37d597.jpg" 
          alt="Salon reception area with two women, one with long brown hair wearing a red top standing behind the counter, and the other with curly red hair sitting in front of the counter holding a card, modern salon interior with chairs and large windows" 
          class="img-fluid rounded-3" 
          width="600" 
          height="320" 
          style="object-fit: cover;"
        />
      </div>
    </main>
  </div>

  <main class="features-container">
    <h1 class="title">Key Inventory Management Features</h1>
    <p class="subtitle">
      Our inventory management solutions offer real-time tracking, automated alerts, and seamless integration, ensuring optimal stock levels and efficient operations for your business.
    </p>

    <div class="feature-row">
      <img
        src="https://storage.googleapis.com/a1aa/image/352f96e6-228c-4ebd-b818-a456904645ef.jpg"
        alt="Orange forklift moving wood pallets in a warehouse with shelves full of materials"
        class="feature-image"
        width="320"
        height="200"
        loading="lazy"
      />
      <div class="feature-text">
        <p class="feature-label">Real-Time Tracking</p>
        <h2 class="feature-title">Track Stock Levels</h2>
        <p class="feature-desc fs-5">
          Monitor inventory levels in real time across all locations. Minimize stockouts and overstocking with accurate data at your fingertips.
        </p>
        <ul>
          <li>
            <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M6.173 14.727a.75.75 0 0 1-1.06 0L.47 10.083a.75.75 0 0 1 1.06-1.06l3.643 3.643 7.72-7.72a.75.75 0 0 1 1.06 1.06L6.173 14.727z"/></svg>
            Instant Stock Updates
          </li>
          <li>
            <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M6.173 14.727a.75.75 0 0 1-1.06 0L.47 10.083a.75.75 0 0 1 1.06-1.06l3.643 3.643 7.72-7.72a.75.75 0 0 1 1.06 1.06L6.173 14.727z"/></svg>
            Optimize Inventory Levels
          </li>
          <li>
            <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M6.173 14.727a.75.75 0 0 1-1.06 0L.47 10.083a.75.75 0 0 1 1.06-1.06l3.643 3.643 7.72-7.72a.75.75 0 0 1 1.06 1.06L6.173 14.727z"/></svg>
            Reduce Carrying Costs
          </li>
        </ul>
      </div>
    </div>

    <div class="feature-row reverse">
      <img
        src="https://storage.googleapis.com/a1aa/image/96552ccf-c0c1-44e9-a984-af5a8c689f60.jpg"
        alt="Two people working on laptop and documents with pen in hand"
        class="feature-image"
        width="320"
        height="200"
        loading="lazy"
      />
      <div class="feature-text">
        <p class="feature-label">Automated Alerts</p>
        <h2 class="feature-title">Stay Informed Always</h2>
        <p class="feature-desc">
          Receive automated alerts for low stock, reorder points, and expiring items. Proactively manage your inventory to prevent disruptions and maintain optimal stock levels with ease.
        </p>
        <ul>
          <li>
            <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M6.173 14.727a.75.75 0 0 1-1.06 0L.47 10.083a.75.75 0 0 1 1.06-1.06l3.643 3.643 7.72-7.72a.75.75 0 0 1 1.06 1.06L6.173 14.727z"/></svg>
            Avoid Stockouts
          </li>
          <li>
            <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M6.173 14.727a.75.75 0 0 1-1.06 0L.47 10.083a.75.75 0 0 1 1.06-1.06l3.643 3.643 7.72-7.72a.75.75 0 0 1 1.06 1.06L6.173 14.727z"/></svg>
            Improve Planning
          </li>
          <li>
            <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M6.173 14.727a.75.75 0 0 1-1.06 0L.47 10.083a.75.75 0 0 1 1.06-1.06l3.643 3.643 7.72-7.72a.75.75 0 0 1 1.06 1.06L6.173 14.727z"/></svg>
            Reduce Spoilage
          </li>
        </ul>
      </div>
    </div>

    <div class="feature-row">
      <img
        src="https://storage.googleapis.com/a1aa/image/57c6a1cd-6f5e-4086-5548-f5e5ace798eb.jpg"
        alt="Open laptop showing data charts on a wooden table"
        class="feature-image"
        width="320"
        height="200"
        loading="lazy"
      />
      <div class="feature-text">
        <p class="feature-label">Seamless Integration</p>
        <h2 class="feature-title">Integrate With Ease</h2>
        <p class="feature-desc">
          Connect your inventory system with accounting, e-commerce, and other platforms. Streamline operations and improve data accuracy across your business.
        </p>
        <ul>
          <li>
            <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M6.173 14.727a.75.75 0 0 1-1.06 0L.47 10.083a.75.75 0 0 1 1.06-1.06l3.643 3.643 7.72-7.72a.75.75 0 0 1 1.06 1.06L6.173 14.727z"/></svg>
            Automated Data Sync
          </li>
          <li>
            <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M6.173 14.727a.75.75 0 0 1-1.06 0L.47 10.083a.75.75 0 0 1 1.06-1.06l3.643 3.643 7.72-7.72a.75.75 0 0 1 1.06 1.06L6.173 14.727z"/></svg>
            Improve Data Accuracy
          </li>
          <li>
            <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M6.173 14.727a.75.75 0 0 1-1.06 0L.47 10.083a.75.75 0 0 1 1.06-1.06l3.643 3.643 7.72-7.72a.75.75 0 0 1 1.06 1.06L6.173 14.727z"/></svg>
            Reduce Manual Errors
          </li>
        </ul>
      </div>
    </div>
  </main>

  <div class="container py-5">
    <h2 class="text-center mb-5 fw-semibold" style="font-size: 1.5rem;">
      Our Inventory Management Services
    </h2>
    <div class="row g-4 mb-4">
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="service-card">
          <div class="icon-circle">
            <i class="fas fa-list"></i>
          </div>
          <h3 class="fw-semibold mb-2" style="font-size: 0.875rem;">System Setup</h3>
          <p class="small mb-0" style="line-height: 1.4;">
            We handle the initial setup of your inventory management system,
            ensuring a smooth transition and minimal disruption to your
            operations. Focus on your business, not the setup.
          </p>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="service-card">
          <div class="icon-circle">
            <i class="fas fa-cog"></i>
          </div>
          <h3 class="fw-semibold mb-2" style="font-size: 0.875rem;">Support</h3>
          <p class="small mb-0" style="line-height: 1.4;">
            Our dedicated support team is available to assist you with any
            questions or issues. Receive prompt and reliable support to ensure
            your inventory management system runs smoothly and efficiently.
          </p>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="service-card">
          <div class="icon-circle">
            <i class="fas fa-flag"></i>
          </div>
          <h3 class="fw-semibold mb-2" style="font-size: 0.875rem;">Integration</h3>
          <p class="small mb-0" style="line-height: 1.4;">
            Seamlessly integrate your inventory management system with other
            business tools. Connect with accounting software, e-commerce
            platforms, and more to streamline operations and improve data
            accuracy.
          </p>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="service-card">
          <div class="icon-circle">
            <i class="fas fa-receipt"></i>
          </div>
          <h3 class="fw-semibold mb-2" style="font-size: 0.875rem;">Training</h3>
          <p class="small mb-0" style="line-height: 1.4;">
            Empower your team with our comprehensive training programs. Learn
            how to effectively use the inventory management system, optimize
            processes, and maximize the benefits for your organization.
          </p>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="service-card">
          <div class="icon-circle">
            <i class="fas fa-cogs"></i>
          </div>
          <h3 class="fw-semibold mb-2" style="font-size: 0.875rem;">Customization</h3>
          <p class="small mb-0" style="line-height: 1.4;">
            Tailor your inventory management system to meet your specific
            business needs. Our customization services ensure that your system
            aligns perfectly with your unique workflows and requirements,
            enhancing overall efficiency.
          </p>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 d-flex">
        <div class="service-card">
          <div class="icon-circle">
            <i class="fas fa-adjust"></i>
          </div>
          <h3 class="fw-semibold mb-2" style="font-size: 0.875rem;">Data Analysis</h3>
          <p class="small mb-0" style="line-height: 1.4;">
            Gain insights into your inventory performance with our comprehensive
            data analysis services. Identify trends, optimize stock levels, and
            make informed decisions to improve profitability and efficiency.
          </p>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center gap-3">
      <button class="btn-learn">Learn More</button>
      <button class="btn-see">See More</button>
    </div>
  </div>

  <main class="container py-5" style="max-width: 768px;">
    <h1 class="text-center mb-5 fw-semibold fs-4">Frequently Asked Questions</h1>
    <section>
      <div class="mb-4">
        <p class="fw-semibold mb-1">What is Inventory Management System?</p>
        <p class="answer mb-0">An Inventory Management System is a tool to track goods across your supply chain.</p>
      </div>
      <div class="mb-4">
        <p class="fw-semibold mb-1">How does real-time tracking work?</p>
        <p class="answer mb-0">Our system updates stock levels instantly with each transaction.</p>
      </div>
      <div class="mb-4">
        <p class="fw-semibold mb-1">Is the system easy to use?</p>
        <p class="answer mb-0">Yes, our user-friendly interface ensures a smooth experience.</p>
      </div>
      <div class="mb-4">
        <p class="fw-semibold mb-1">Can I integrate with my accounting software?</p>
        <p class="answer mb-0">Yes, our system integrates seamlessly with major accounting platforms.</p>
      </div>
    </section>
  </main>

  <div class="container py-5">
    <h2 class="text-center fw-bold mb-2">What Our Clients Say</h2>
    <p class="text-center mx-auto mb-5" style="max-width: 36rem; font-size: 0.875rem; line-height: 1.5;">
      Discover how Inventory Management Solutions has transformed businesses. Read testimonials from satisfied clients who have experienced improved efficiency and profitability.
    </p>
    <div class="row g-4">
      <div class="col-12 col-md-6">
        <div class="testimonial-card">
          <p class="testimonial-text">
            Inventory Management Solutions has revolutionized our stock control. Real-time tracking and automated alerts have significantly reduced stockouts and improved our overall efficiency. Highly recommended!
          </p>
          <div class="testimonial-footer">
            <div class="client-info">
              <img
                src="https://storage.googleapis.com/a1aa/image/9f0b45c6-4a2e-4436-2235-f1ee5cc4978c.jpg"
                alt="Portrait of Jane Doe, a woman with light skin and blonde hair, smiling and wearing a beige top"
                class="rounded-circle"
                width="40"
                height="40"
              />
              <div>
                <p class="client-name mb-1">Jane Doe</p>
                <div class="star-rating">
                  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
              </div>
            </div>
            <i class="fas fa-quote-right quote-icon"></i>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="testimonial-card">
          <p class="testimonial-text">
            Thanks to Inventory Management Solutions, we’ve optimized our inventory levels and reduced carrying costs. The system is user-friendly, and the support team is always responsive and helpful.
          </p>
          <div class="testimonial-footer">
            <div class="client-info">
              <img
                src="https://storage.googleapis.com/a1aa/image/1c495e55-b7eb-4715-c638-8b4fd959d13f.jpg"
                alt="Portrait of Anna Smith, a woman with light skin and dark brown hair, smiling and wearing a red top"
                class="rounded-circle"
                width="40"
                height="40"
              />
              <div>
                <p class="client-name mb-1">Anna Smith</p>
                <div class="star-rating">
                  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
              </div>
            </div>
            <i class="fas fa-quote-right quote-icon"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="container py-5">
    <div class="row">
      <div class="col-12 col-md-4 mb-4 mb-md-0">
        <h2 class="fw-semibold mb-3">stockinventory</h2>
        <p class="mb-0" style="max-width: 320px; line-height: 1.5;">
          Streamline your inventory with stockinventory. Real-time tracking, automated alerts, and insightful analytics for optimal stock management and business growth. Try it now!
        </p>
      </div>
      <div class="col-12 col-md-4 mb-4 mb-md-0">
        <h3 class="fw-semibold mb-3">Company</h3>
        <ul class="list-unstyled mb-0">
          <li class="mb-2">About Us</li>
          <li class="mb-2">Contact Us</li>
          <li class="mb-2">Our Services</li>
          <li>Privacy Policy</li>
        </ul>
      </div>
      <div class="col-12 col-md-4">
        <h3 class="fw-semibold mb-3">Contact</h3>
        <p class="mb-2">info@stockinventory.com</p>
        <p class="mb-3">+15551234567</p>
        <div>
          <a href="#" class="text-dark me-3" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-dark me-3" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-dark" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>