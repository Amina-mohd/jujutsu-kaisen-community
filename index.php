<?php
include_once 'connect.php';
include_once 'header.php';
?>

<html5 lang="en">
<body>
    <div class="extra-space">

        <!--Home section-->
        <div id="home">
            <!--Login icon and Logout button-->
            <div class="user-icon-container">
                <?php
                // Check if the user is logged in via Google
                if (isset($_SESSION['google_loggedin']) && $_SESSION['google_loggedin'] == TRUE) {
                    //Profile image container
                    echo '<div class="profile-image-container">';
                    // Display the Google profile image
                    echo '<img src="' . htmlspecialchars($_SESSION['google_picture']) . '" alt="Profile Image" class="user-icon">';
                    echo '<div class="overlay"></div>';
                    // Close the profile image container
                    echo '</div>';

                    // Display logout button
                    echo '<div class="logout-container">
                             <form action="logout.php" method="post">
                                 <button type="submit" name="logout" class="logout-button">
                                     <i class="fa-solid fa-right-from-bracket"></i>
                                 </button>
                             </form>
                          </div>';
                } elseif (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == TRUE) {
                    // User is logged in but not via Google, display default user icon
                    echo '<i class="fa-solid fa-user user-icon"></i>';

                    // Display logout button
                    echo '<div class="logout-container">
                             <form action="logout.php" method="post">
                                <button type="submit" name="logout" class="logout-button">
                                   <i class="fa-solid fa-right-from-bracket"></i>
                                </button>
                             </form>
                          </div>';
                } else {
                    // User is not logged in, display login icon and text
                    echo '<a href="login.php" class="login-link"><i class="fa-solid fa-right-to-bracket"></i> login</a>';
                }
                ?>
            </div>

            <!--The logo-->
            <div class="jjk-logo">
                <img src="images/logo (jp).png" alt="Logo image" />

                <div class="logo-text">
                    <p>
                        Welcome to our Jujutsu Kaisen community! Dive into the thrilling world of Yuji Itadori, a high school student navigating a realm of curses and jujutsu sorcery. Join us to discuss, share, and celebrate this captivating manga and anime series.
                        <br />
                        <br />
                        Ready to experience the action? Click here to watch Jujutsu Kaisen and immerse yourself in the world of curses and jujutsu sorcery!
                    </p>

                    <!--Button -->
                    <div class="button-container">
                        <span class="mas"><i class="fa-solid fa-play"></i> Watch here</span>
                        <button id="work" type="button" name="Hover" onclick="window.location.href='https://www.crunchyroll.com/series/GRDV0019R/jujutsu-kaisen'"><i class="fa-solid fa-play"></i> Watch here</button>
                    </div>
                </div>
            </div>

        </div>

        <!--Story section-->
        <div id="story">
            <div class="story-content fade-in">
                <div class="heading-container fade-in">
                    <img src="images/mark 1.png" alt="Left Decorative Image" class="decorative-image left-image">
                    <h1>Jujutsu Kaisen: A Tale of Curses and Courage</h1>
                    <img src="images/mark 2.png" alt="Right Decorative Image" class="decorative-image right-image">
                </div>

                <hr class="s-hr" />

                <p>
                    In the shadowy realm where negative emotions breed monstrous entities known as Curses, Jujutsu Sorcerers stand as humanity's clandestine guardians. <span class="highlight">Jujutsu Kaisen</span> chronicles the perilous journey of Yuji Itadori, a high schooler with unsuspected potential, thrust into this cryptic world after an encounter with a cursed relic.
                    <br><br>
                    When Yuji ingests the finger of the ancient and malevolent Curse, <span class="highlight">Ryomen Sukuna</span>, he finds himself entangled in the fateful role of a host to this formidable entity. With Sukuna's power coursing through his veins, Yuji must navigate the treacherous path of a Jujutsu Sorcerer, confronting the darkness within and the threats that lurk in the shadows.
                    <br><br>
                    Balancing the fine line between control and chaos, Yuji joins forces with other Sorcerers, engaging in battles that test the limits of their courage and resolve. Each skirmish, a dance with death, brings them closer to understanding the true nature of strength and the cost of wielding it.
                    <br>
                    <span class="highlight">Jujutsu Kaisen</span> is a saga of growth, sacrifice, and the relentless pursuit of a world free from the curse of malevolence. It's a story that resonates with the heart's deepest fears and the spirit's brightest hopes.
                </p>
            </div>
        </div>


        <!--Characters section-->
        <div id="characters">

            <div class="heading-container fade-in">
                <img src="images/mark 1.png" alt="Left Decorative Image" class="decorative-image left-image">
                <h1>Characters</h1>
                <img src="images/mark 2.png" alt="Right Decorative Image" class="decorative-image right-image">
            </div>
            
            <hr class="c-hr" />

            <div class="character-section">
                <!-- Character Display Container -->
                <div id="character-display" class="character-display">
                     <!-- Character Image -->
                    <img src="images/characters/yuji_itadori.png" alt="Yuji Itadori image" class="character-image">
                </div>

                <div class="character-box">
                    <div class="character-info-container">
                        <!-- Character Name -->
                        <h2 class="character-name">Itadori Yuji</h2>
  
                        <!-- Character Info -->
                        <p class="character-info">
                            Yuji Itadori is the main protagonist of Jujutsu Kaisen. Known for his exceptional physical abilities and kind heart, Yuji becomes a vessel for the powerful Cursed Spirit, Ryomen Sukuna, after consuming one of Sukuna's fingers. Despite the immense danger posed by housing Sukuna, Yuji remains determined to use his newfound powers to protect others and honor his grandfather's dying wish to help those in need. His journey is marked by his struggle to balance his humanity with the curse within.
                        </p>
                    </div>

                    <!-- Character Slider Container -->
                    <div class="character-slider">
                    
                        <!-- Character Slider Inner (to apply the sliding effect) -->
                        <div class="character-slider-inner">
                            <!-- Character Icon -->
                            <img src="images/characters/yuji_itadori.png" alt="Yuji Itadori" class="character-icon" onclick="displayCharacter('character1')">
                            <img src="images/characters/megumi (edit).png" alt="Fushigoro Megumi" class="character-icon" onclick="displayCharacter('character2')">
                            <img src="images/characters/nobara (edit).png" alt="Nobara Kugisaki" class="character-icon" onclick="displayCharacter('character3')">
                            <img src="images/characters/gojo.png" alt="Gojo Satoru" class="character-icon" onclick="displayCharacter('character4')">
                            <img src="images/characters/nanami.png" alt="Nanami Kento" class="character-icon" onclick="displayCharacter('character5')">
                            <img src="images/characters/toji.png" alt="Toji Fushigoro" class="character-icon" onclick="displayCharacter('character6')">
                            <img src="images/characters/shoko.png" alt="Shoko Ieiri" class="character-icon" onclick="displayCharacter('character7')">
                            <img src="images/characters/geto.png" alt="Geto Suguru" class="character-icon" onclick="displayCharacter('character8')">
                            <img src="images/characters/mahito.png" alt="Mahito" class="character-icon" onclick="displayCharacter('character9')">
                            <img src="images/characters/sukuna.png" alt="Ryomen sukuna" class="character-icon" onclick="displayCharacter('character10')">
                        </div>
                        
                        <div class="carousel-control left" onclick="slideCarousel('left')"><i class="fa-solid fa-circle-arrow-left"></i></div>
                        <div class="carousel-control right" onclick="slideCarousel('right')"><i class="fa-solid fa-circle-arrow-right"></i></div>
                    </div>
                </div>
            </div>
            
        </div>


        <div id="media">
           <!-- Media page content goes here -->
        </div>

    </div>

    <!-- 
        <footer>
        <div class="footer-content">
            <p>© 2024 Jujutsu Kaisen Community. All rights reserved.</p>
            <p>Contact us: <a href="mailto:aminamohd56348@gmail.com">contact@jjkcommunity.com</a></p>
            <p>This website is created for educational purposes and is not officially affiliated with the creators of Jujutsu Kaisen.</p>
        </div>
    </footer>

     -->

    <footer class="footer">
        <div class="footer-container">
            <!-- Social Icons -->
            <div class="social-icons">
                <a href="https://www.facebook.com/jujutsu.kaisen.official?mibextid=ZbWKwL" target="_blank" class="social-icon">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                
                <a href="https://www.instagram.com/jujutsukaisen?igsh=MXBxOXB2dTczY3UxNg==" target="_blank" class="social-icon">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                
                <a href="https://x.com/jujutsu_kaisen_?lang=en" target="_blank" class="social-icon">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                
                <a href="https://www.crunchyroll.com/series/GRDV0019R/jujutsu-kaisen" target="_blank" class="social-icon">
                    <img src="images/crunchyroll (edit).png" alt="Crunchyroll" />
                </a>

            </div>

            <!-- Footer Content -->
            <div class="footer-content">
                <p><i class="fa-regular fa-copyright"></i> 2024 Jujutsu Kaisen Community. All rights reserved.</p>
                <div class="contact-info">
                    <p>Contact Us:</p>
                    <a href="mailto:aminamohd56348@gmail.com">contact@jjkcommunity.com</a>
                </div>
                <p class="f-info">This website is created for educational purposes only and is not officially affiliated with the creators of Jujutsu Kaisen.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript to scroll to top on page load -->
    <script>
        window.onload = function () {
            // Check if the URL contains a hash
            if (!window.location.hash) {
                // If no hash, scroll to the top of the page
                window.setTimeout(function () {
                    window.scrollTo(0, 0);
                }, 10);
            }
        };
    </script>
</body>
</html5>