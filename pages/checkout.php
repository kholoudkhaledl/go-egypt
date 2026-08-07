<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Go Egypt</title>

    <link rel="stylesheet" href="../assets/css/checkout.css">
</head>
<body>

    <div class="header">
        <h1>Go Egypt</h1>
    </div>

    <div class="container">
        

        <div class="left-side">
            <div class="card">
                <h3 class="card-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Visitor Information
                </h3>
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="John Doe">
                </div>

                <div class="row">
                    <div class="form-group" style="flex:1;">
                        <label>Email Address</label>
                        <input type="email" placeholder="john@example.com">
                    </div>
                    <div class="form-group" style="flex:1;">
                        <label>Phone Number</label>
                        <input type="tel" placeholder="+123456789">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nationality</label>
                    <select>
                        <option>Select Nationality</option>
                        <option>Egyptian</option>
                        <option>Foreigner</option>
                    </select>
                </div>
            </div>

         
            <div class="card">
                <h3 class="card-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                    Payment Method
                </h3>

                <!-- first choice -->
                <div class="payment-box">
                    <input type="radio" id="card" name="payment_method" checked>
                    <label for="card" class="payment-header">
                        <span class="radio-label">Credit / Debit Card</span>
                        <span class="icon">💳</span>
                    </label>

                    <div class="payment-body">
                        <div class="form-group">
                            <label>Card Number</label>
                            <input type="text" placeholder="0000 0000 0000 0000">
                        </div>

                        <div class="row">
                            <div class="form-group" style="flex:1;">
                                <label>Expiry Date</label>
                                <input type="text" placeholder="MM/YY">
                            </div>
                            <div class="form-group" style="flex:1;">
                                <label>CVV</label>
                                <input type="password" placeholder="123">
                            </div>
                        </div>
                    </div>
                </div>

              <!-- second choice, E wallet  -->
                <div class="payment-box">
                    <input type="radio" id="wallet" name="payment_method">
                    <label for="wallet" class="payment-header">
                        <span class="radio-label">E-Wallets (Vodafone Cash / InstaPay)</span>
                        <span class="icon">👛</span>
                    </label>

                    <div class="payment-body">
                        <div class="form-group">
                            <label> Wallet Phone Number / InstaPay IPA </label>
                            <input type="text" placeholder="010xxxxxxxx or username@instapay">
                        </div>
                    </div>
                </div>

              <!-- third choice -->
                <div class="payment-box">
                    <input type="radio" id="onsite" name="payment_method">
                    <label for="onsite" class="payment-header">
                        <span class="radio-label">Pay On-Site (At Entrance)</span>
                        <span class="icon">🏛️</span>
                    </label>

                    <div class="payment-body">
                        <p style="font-size: 13px; color: #666; margin: 0;">You can pay in cash or by card upon your arrival at the entrance desk.</p>
                    </div>
                </div>

            </div>

        </div>

       
        <div class="right-side">
            <div class="card">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzZnWdXRxs7j4RUvXD2tuCuaABXTjgqoGXIeIFJ_8RYDEE_pVK2TLLnOiSrIstZ00lydXM7btIE--W6nPM68o-wQWpBIzfTzFfyeisOWLQhDzWG17G_AxC1ljxo8lfLsTm8bXXLJjGqa-YBRFRAD-k0H8aG19vA7LwJt-zKFurzahGSxRJX34fy5odpXPfhL0wIHh6xnZQMNys9dfFxFwQd16KTdG2h2BzZwG-6jRFU6xGhzPRrrs1rw" class="summary-img" alt="Karnak Temple">
                
                <h4 style="margin: 15px 0 5px 0;">Karnak Temple</h4>
                <p style="color: #777; font-size: 12px; margin-top: 0;">Luxor, Egypt</p>
                <hr style="border: 0.5px solid #eee;">

                <div class="row-space">
                    <span>Date:</span>
                    <strong>May 15, 2024</strong>
                </div>
                <div class="row-space">
                    <span>Tickets:</span>
                    <strong>2x Adult</strong>
                </div>
                <div class="row-space">
                    <span>Subtotal:</span>
                    <span>800 EGP</span>
                </div>
                <div class="row-space">
                    <span>Service Fee:</span>
                    <span>40 EGP</span>
                </div>
                <hr style="border: 0.5px solid #eee;">
                
                <div class="row-space">
                    <strong>Total:</strong>
                    <span class="total-price">840 EGP</span>
                </div>

                <button class="btn-submit">Complete Payment & Confirm</button>
            </div>
        </div>

    </div>

</body>
</html>