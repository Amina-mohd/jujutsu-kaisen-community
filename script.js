// JavaScript to toggle side-nav
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.hamburger-menu').addEventListener('click', function (event) {
        var navbar = document.getElementById('navbar');
        navbar.classList.toggle('nav-active'); // This line adds or removes the .nav-active class

        // Stop propagation of the click event
        event.stopPropagation();
    });

    // Toggle side-nav for close icon
    document.querySelector('.close-menu').addEventListener('click', function (event) {
        var navbar = document.getElementById('navbar');
        navbar.classList.toggle('nav-active');

        // Stop propagation of the click event
        event.stopPropagation();
    });
});

// New code to navigate to full path on click events on .nav-link elements
document.querySelectorAll('.nav-link').forEach(function (navLink) {
    navLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default action
        window.location.href = this.href; // Navigate to the full path of the href
    });
});

// Existing code for onload screen image
window.addEventListener('load', () => {
    document.getElementById('loading').style.display = 'none';
});

// Fading animation on scroll
document.addEventListener('DOMContentLoaded', function () {
    var storyContent = document.querySelector('.story-content');
    var storyContentVisible = false; // Flag to check if animation has been played

    // Function to check if the element is in the viewport
    function isInViewport(element) {
        var rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
        );
    }

    // Listen for scroll events
    window.addEventListener('scroll', function () {
        // Check if the .story-content is in the viewport and the animation has not been played
        if (isInViewport(storyContent) && !storyContentVisible) {
            storyContent.classList.add('fade-in');
            storyContentVisible = true; // Set the flag to true after animation plays
        }
    });
});

// Characters slider
var currentSlide = 0;
var maxSlide = 10; // Total number of slides

function displayCharacter(characterId) {
    var characterInfo = {
        'character1': {
            'image': 'images/characters/yuji_itadori.png',
            'name': 'Itadori Yuji',
            'intro': "Yuji Itadori is the main protagonist of Jujutsu Kaisen. Known for his exceptional physical abilities and kind heart, Yuji becomes a vessel for the powerful Cursed Spirit, Ryomen Sukuna, after consuming one of Sukuna's fingers.Despite the immense danger posed by housing Sukuna, Yuji remains determined to use his newfound powers to protect others and honor his grandfather's dying wish to help those in need. His journey is marked by his struggle to balance his humanity with the curse within."
        },
        'character2': {
            'image': 'images/characters/megumi (edit).png',
            'name': 'Fushigoro Megumi',
            'intro': "Megumi Fushiguro is a first-year student at Tokyo Jujutsu High and a skilled jujutsu sorcerer. He possesses the Ten Shadows Technique, which allows him to summon and control shikigami. Megumi is reserved and serious, often acting as a counterbalance to Yuji's exuberance. Despite his stoic exterior, he is deeply compassionate and values the lives of others, sometimes even over his own safety."
        },
        'character3': {
            'image': 'images/characters/nobara (edit).png',
            'name': 'Kugisaki Nobara',
            'intro': "Kugisaki Nobara is a fiery and confident first-year student at Tokyo Jujutsu High. Hailing from the countryside, she brings a unique blend of strength, wit, and charm to the team. Nobara wields a hammer and nails imbued with cursed energy and can manipulate voodoo dolls to attack her enemies from afar. Her fierce determination and loyalty to her friends drive her to face even the most terrifying curses head-on."
        },
        'character4': {
            'image': 'images/characters/gojo.png',
            'name': 'Gojo Satoru',
            'intro': "Satoru Gojo is a powerful jujutsu sorcerer and teacher at Tokyo Jujutsu High. Known for his striking white hair and blindfolded appearance, Gojo is widely regarded as the strongest sorcerer in the world. His Limitless Cursed Technique, combined with the Six Eyes, grants him unparalleled combat prowess and perception. Despite his laid-back and often playful demeanor, Gojo is deeply committed to reforming the jujutsu society and protecting his students."
        },
        'character5': {
            'image': 'images/characters/nanami.png',
            'name': 'Nanami Kento',
            'intro': "Kento Nanami is a former salaryman turned jujutsu sorcerer, known for his pragmatic and professional approach to exorcism. He wields a blunt sword imbued with cursed energy and employs a precise combat style, utilizing his Ratio Technique to exploit weak points in his opponents. Nanami's stoic demeanor and strict sense of duty contrast with his underlying care for his colleagues and a desire to protect the innocent."
        },
        'character6': {
            'image': 'images/characters/toji.png',
            'name': 'Toji Fushigoro',
            'intro': "Toji Fushiguro, also known as the Sorcerer Killer, is a formidable non-sorcerer assassin. Born without cursed energy, Toji relies on his immense physical strength and cunning, using a variety of cursed tools to defeat even the most powerful sorcerers. He is the estranged father of Megumi Fushiguro, and his complex past and ruthless nature make him a feared and enigmatic figure within the jujutsu world."
        },
        'character7': {
            'image': 'images/characters/shoko.png',
            'name': 'Shoko Ieiri',
            'intro': "Shoko Ieiri is the medical doctor at Tokyo Jujutsu High and a former classmate of Satoru Gojo and Suguru Geto. She possesses healing abilities that allow her to treat injuries inflicted by curses, making her an invaluable asset to the school. Shoko's calm and composed nature, combined with her expertise, ensures the well-being of the students and sorcerers who rely on her medical skills."
        },
        'character8': {
            'image': 'images/characters/geto.png',
            'name': 'Geto Suguru',
            'intro': "Suguru Geto is a former jujutsu sorcerer who turned rogue, becoming one of the primary antagonists in Jujutsu Kaisen. Once a close friend of Satoru Gojo, Geto's ideology shifted towards a belief that sorcerers are superior beings who should rule over non-sorcerers. His ability to control and manipulate cursed spirits makes him a formidable and dangerous adversary, driven by a vision of creating a world only for jujutsu sorcerers."
        },
        'character9': {
            'image': 'images/characters/mahito.png',
            'name': 'Mahito',
            'intro': "Mahito is a sadistic and twisted Cursed Spirit with the ability to manipulate the shape and soul of humans through his Idle Transfiguration technique. He embodies the cruelty and chaos of curses, taking pleasure in causing suffering and death. Mahito's childlike curiosity and philosophical musings about the nature of humanity and curses make him a particularly chilling antagonist in the series."
        },
        'character10': {
            'image': 'images/characters/sukuna.png',
            'name': 'Ryomen Sukuna',
            'intro': "Ryomen Sukuna, often referred to simply as Sukuna, is a legendary Cursed Spirit known as the King of Curses. He possesses immense power and malevolence, with his fingers scattered and preserved as cursed objects. When Yuji Itadori consumes one of Sukuna's fingers, Sukuna becomes partially resurrected within Yuji's body. Sukuna is ruthless, arrogant, and enjoys challenging and tormenting those he deems weak, making him a constant threat to both Yuji and the world of jujutsu sorcery."
        }

    };

    // Get the character data
    var characterData = characterInfo[characterId];

    // Update the character image
    var characterImage = document.querySelector('.character-image');
    characterImage.src = characterData.image;
    characterImage.alt = characterData.name;

    // Update the character name
    var characterName = document.querySelector('.character-name');
    characterName.textContent = characterData.name;

    // Update the character intro
    var characterIntro = document.querySelector('.character-info');
    characterIntro.textContent = characterData.intro;
}

function slideCarousel(direction) {
    var slider = document.querySelector('.character-slider-inner');
    var slideWidth = 110; // Width of each slide (icon width + margin-right)

    if (direction === 'left' && currentSlide > 0) {
        currentSlide--;
    } else if (direction === 'right' && currentSlide < maxSlide - 5) {
        currentSlide++;
    }

    var transformValue = -slideWidth * currentSlide;
    slider.style.transform = 'translateX(' + transformValue + 'px)';
}

// Add event listeners for carousel controls
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.carousel-control.left').addEventListener('click', function () {
        slideCarousel('left');
    });

    document.querySelector('.carousel-control.right').addEventListener('click', function () {
        slideCarousel('right');
    });
});
