<?php
date_default_timezone_set('America/Chicago');

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// turn off debug mode for live site
$app['debug'] = (gethostname() == 'web01') ? false : true;

// register twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

$app['conference_year'] = "2018";

$published_menu = array(
    'Home' => '/',
    'Tickets' => '/tickets/',
//    'Schedule' => '/schedule/',
    'Speakers' => '/speakers/',
    'Venue/Hotel' => '/venue/',
    'Sponsors' => '/sponsors/',
    'What to Expect' => '/expect/',
//    'Call for Papers' => 'https://cfp.madisonphpconference.com',
    'Code of Conduct' => '/conduct/',
    'Contact' => 'https://contact.madisonphpconference.com'
);

$app['nav'] = $published_menu;

$sponsors = array(
    'partner' => array(
        array(
            'name' => '',
            'href' => '',
            'img'  => '',
            'thumbnail' => '',
            'twitter' => '',
        ),
    ),
    'gold' => array(
        array(
            'name' => '',
            'href' => '',
            'img'  => '',
            'thumbnail' => '',
            'twitter' => '',
        ),
    ),
    'silver' => array(
        array(
            'name' => 'Madison College',
            'href' => 'http://it.madisoncollege.edu',
            'img'  => '/assets/images/sponsors/madisoncollege.jpg',
            'thumbnail' => '/assets/images/sponsors/madisoncollege_thumb.jpg',
            'twitter' => 'MadisonIT',
        ),
        array(
            'name' => 'Snap Programming',
            'href' => 'http://snapprogramming.com/',
            'img'  => '/assets/images/sponsors/snapprogramming.png',
            'thumbnail' => '/assets/images/sponsors/snapprogramming_thumb.png',
            'twitter' => 'SnapProgramming',
        ),
    ),
    'bronze' => array(
        array(
            'name' => 'OSMI',
            'href' => 'https://osmihelp.org',
            'img'  => '/assets/images/sponsors/osmi.png',
            'thumbnail' => '/assets/images/sponsors/osmi_thumb.png',
            'twitter' => 'osmihelp',
        ),
        array(
            'name' => 'Earthling Interactive',
            'href' => 'https://earthlinginteractive.com/',
            'img'  => '/assets/images/sponsors/earthling.png',
            'thumbnail' => '/assets/images/sponsors/earthling_thumb.png',
            'twitter' => 'WeAreEarthling',
        ),
        array(
            'name' => 'SiteGround',
            'href' => 'http://www.siteground.com',
            'img'  => '/assets/images/sponsors/siteground.png',
            'thumbnail' => '/assets/images/sponsors/siteground_thumb.png',
            'twitter' => 'SiteGround',
        ),
    ),
    'scholarship' => array(
        array(
            'name' => '',
            'href' => '',
            'img'  => '',
            'thumbnail' => '',
            'twitter' => '',
        ),
    ),
    'community' => array(
        array(
            'name' => '',
            'href' => '',
            'img'  => '',
            'thumbnail' => '',
            'twitter' => '',
        ),
    ),
);

$app['sponsors'] = $sponsors;

$schedule_set = 'no';
$rooms_set= 'no';
$speakers_set= 'yes';

$app['schedule_set'] = $schedule_set;
$app['rooms_set'] = $rooms_set;
$app['speakers_set'] = $speakers_set;

$sessions = array(
    'T01' => array(
        'speaker' => array (
            array (
                'name' => 'Edward Barnard',
                'img' => 'Edward_Barnard.jpg',
                'bio' => 'Ed Barnard had a front-row seat when the Morris Worm took down the Internet, November 1988. He was teaching CRAY-1 supercomputer operating system internals to analysts as they were being directly hit by the Worm. It was a busy week! Ed continues to indulge his interests in computer security and teaching software concepts to others.',
                'twitter' => 'ewbarnard',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Binary for IoT',
                'tagline' => '',
                'talk_description' => 'We\'ve come full circle: A generation ago people were expected to manipulate binary numbers. Those forgotten skills are coming back into demand. The Raspberry Pi, IoT microcontrollers, network code, pure-PHP libraries, all deal with binary-based interfaces or hardware pins. This tutorial focuses on learning the software skills you need for working close to the hardware. We\'ll "learn binary" and practice this knowledge with two pure PHP projects. We\'ll first learn and use AND, OR, XOR to build a binary adder implementing Boolean logic gates in PHP. Next we learn shifting, masking, one\'s complement, two\'s complement for our second PHP project: Implement your own algorithm converting decimal to hexadecimal without sprintf(). This hands-on tutorial focuses on gaining a strong working knowledge of the skills you need for working close to modern IoT hardware. Zero prior "binary" knowledge is expected.',
                'talk_type' => 'Tutorial',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T02' => array(
        'speaker' => array (
            array (
                'name' => 'Tim Bond',
                'img' => 'Tim_Bond.jpg',
                'bio' => 'Tim is a senior full stack PHP developer that has been working with PHP for 14 years and has seen PHP grow from its hodgepodged roots to a modern development language.  When not in front of a computer, you\'ll probably find him hiking or biking around beautiful Seattle, or putting together a new Lego set on one of the rare rainy days.',
                'twitter' => 'TimB0nd',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Native Mobile Apps with Tabris.js',
                'tagline' => '',
                'talk_description' => 'Tabris.js is a mobile framework that lets you develop native iOS and Android apps from a single code base written entirely in JavaScript. Tabris.js is fully native (no WebViews! and allows you to use existing JavaScript libraries, node modules and Cordova plugins to build your apps. The developer app lets you reload your code at the push of a button for a fast develop/test cycle. Tabris.js also has an online build service eliminating the need to set up SDKs to generate packages for mobile devices.',
                'talk_type' => 'Tutorial',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T03' => array(
        'speaker' => array (
            array (
                'name' => 'Gunnard Engebreth',
                'img' => 'Gunnard_Engebreth.png',
                'bio' => 'Gunnard Engebreth an E-commerce developer at Full Compass. Hailing from Atlanta, Ga he brings 20+ years of Development experience to this stronghold company.',
                'twitter' => 'gunnard',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Tmux and VIM as an IDE',
                'tagline' => '',
                'talk_description' => 'This is not a talk about VIM VS. EMACS! This is how to use a CLI in a dev/production environment that emphasizes staying on the keyboard. I will show you how to install plugins for VIM that will allow for easy directory navigation, code syntax, and code completion. TMUX will be utilized as a persistent connection and efficient way to re-connect to what you were last just doing.',
                'talk_type' => 'Short Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T04' => array(
        'speaker' => array (
            array (
                'name' => 'Nate Finch',
                'img' => 'Nate_Finch.jpg',
                'bio' => 'Nate has been building websites for individuals, non-profits, embassies, and businesses for about 5 years now. He builds on WordPress, so he and his clients can easily manage and update the sites. He loves web development because it\'s the perfect mix of problem solving, building, and life-long learning. Nate is an avid learner and has made a habit of collecting masters degrees. He\'s also been to six continents (not Antarctica yet!), lived on four, speaks Spanish, and is varying degrees of conversational in a couple other languages. Family, friends, food, coffee, and cooking are his favorite activities outside of work. He now lives in Wisconsin with his wonderful wife and daughter.',
                'twitter' => 'n8finch',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Getting Started with WP-CLI',
                'tagline' => '',
                'talk_description' => 'Do you work with or maintain WordPress sites and wonder if there\'s an easier way to keep things updated? Are you looking for a way to automate a site setup, turning a five minute install into a 5 second install? (Well, at least less than 5 minutes). Are you bogged down by repetitive tasks that you think, "Ugh, OMG!!!, I wish there was a script I could run that would take care of this for me.” Let\'s dig into WP-CLI (the WordPress Command Line Interface) together and see how it can help us get a little more "fun" out of functions, some extra "dates" out of updates (ok, maybe not that... but maybe !not that, if you know what I mean), a little more "me" time from themes and plugins.',
                'talk_type' => 'Talk',
            ),
            array (
                'title' => 'More Secure API Requests with WordPress Helper Functions',
                'tagline' => '',
                'talk_description' => 'Making API requests with JavaScript is something web developers do everyday. API services often require you to keep API keys out of the browser or route your requests through a server to secure the request. These requirements are meant to keep the API secure and not overloaded with hijacked requests. We will look at a workflow in WordPress that will route a request through the server and return the information to the browser without a page refresh. This workflow is particularly useful if you want or need to keep your API keys secret or out of the browser client, and make requests from a server and not the browser.',
                'talk_type' => 'Short Talk',
                'display_speaker' => 'yes',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T05' => array(
        'speaker' => array (
            array (
                'name' => 'Larry Garfield',
                'img' => 'Larry_Garfield.jpg',
                'bio' => 'Larry Garfield has been building websites since he was a sophomore in high school, which is longer ago than he\'d like to admit. Larry was an active Drupal contributor and consultant for over a decade, and led the Drupal 8 Web Services initiative that helped transform Drupal into a modern PHP platform. Larry is Director of Developer Experience at Platform.sh, a leading continuous deployment cloud hosting company. He is also a member of the PHP-FIG Core Committee. Larry holds a Master\'s degree in Computer Science from DePaul University. He blogs at both <a href="https://platform.sh/">https://platform.sh/</a> and <a href="https://www.garfieldtech.com/">https://www.garfieldtech.com/</a>.',
                'twitter' => 'Crell',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Building a cloud-friendly application',
                'tagline' => '',
                'talk_description' => 'The days of hand-crafted artisanal servers are long over. Modern web applications need to be able to run on many different servers without code changes. Not just different hosting providers, but different environments on the same hosting provider. Whether you\'re using a legacy dev/stage/prod setup or a modern branch-is-environment host, modern hosting imposes some requirements on your application design but also offers a huge potential for new and powerful tools. In this session, we\'ll explore some key guidelines for building a cloud-friendly application, as well as look at some architectural options that a modern hosting platform enables.',
                'talk_type' => 'Short Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T06' => array(
        'speaker' => array (
            array (
                'name' => 'Hrushikesh Ghatpande',
                'img' => 'Hrushikesh_Ghatpande.jpg',
                'bio' => 'From Pune, India. Currently living and working in Madison, WI. Manufacturing Engineer by profession. PHP enthusiast and UX philosopher by choice. My job, as a Manufacturing Systems Engineer and UX philosopher is to act as a bridge, who translates real-world requirements and practical considerations into technical write-ups for the UI/UX developers and vice-versa. In my spare time, I enjoy photography, multimedia editing, and social networking. <a href="http://ghatpande.com">http://ghatpande.com</a>',
                'twitter' => 'thehrushi',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'UX Design for the Internet of Things',
                'tagline' => '',
                'talk_description' => 'There has been a tremendous upswing in the use of IoT (Internet of Things) and web-based user interfaces. Data is the new oil, and everyone wants to collect more data on their operations. It\'s all fun and games while the sensors are installed and the data starts flowing in, but working with touchscreens for manual input and displaying the data in real-time can be quite painful if the UI/UX design isn\'t suitable for its application. Learn how to design your interface to handle everyday challenges while being flexible enough to adapt to constantly changing scenarios in the industry. These principles and guidelines will help you create an effective design as well as improve the overall user experience. This talk won\'t just be theoretical but will go through some practical considerations and ways to handle them, using real-world examples.',
                'talk_type' => 'Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T07' => array(
        'speaker' => array (
            array (
                'name' => 'Daniel Greig',
                'img' => 'Daniel_Greig.jpg',
                'bio' => 'Daniel Greig is a team and technical lead at Earthling Interactive. He has worked in a variety of languages and systems over the last 15 years.',
                'twitter' => '',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Extending and Writing with Guttenberg',
                'tagline' => '',
                'talk_description' => 'Guttenberg is wordpress\'s newest method for creating pages. Come and hear about how it will change how you create content, and how you as a programmer can make it easier for editors to create pages.',
                'talk_type' => 'Talk',
            ),
            array (
                'title' => 'Plugins. What are they good for?',
                'tagline' => '',
                'talk_description' => 'In this talk, I will endeavor to answer what do WordPress plugins do and why you would want to use one. I will also be looking at how you would go about creating your own.',
                'talk_type' => 'Workshop',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T08' => array(
        'speaker' => array (
            array (
                'name' => 'Corey Halpin',
                'img' => 'Corey_Halpin.jpg',
                'bio' => 'Corey Halpin is a software engineer at the <a href="https://scout.wisc.edu">Internet Scout Research Group</a> in the Department of Computer Sciences at UW-Madison. Scout works at the intersection of Computer Science and Library and Information Science, creating digital resource collections and software to support them. Our flagship application is the <a href="https://scout.wisc.edu/cwis">Collection Workflow Integration System (CWIS)</a>, an open source (GPL), turn-key package for creating and managing digital libraries. Prior to joining Scout, Corey earned a PhD in Forestry from UW-Madison by using simulation models (written primarily in C++, Perl, Lua, and GNU R) to understand the patterns of biomass development in the forests of northern Wisconsin.',
                'twitter' => '',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Doing more with SSH',
                'tagline' => '',
                'talk_description' => 'SSH is an incredible Swiss-army chainsaw of secure networking. This talk presents a brief overview of how the SSH protocol works, including recommendations on how to configure SSH clients and servers for higher security. This incorporates a brief tutorial on how to create and use ssh keys for authentication, including the use of ssh-agent and agent forwarding so that password-protected keys can be used relatively painlessly. An overview of SSH\'s network tunneling features will be presented, including the use of static and dynamic port forwarding, jump hosts using a ProxyCommand, and light-weight VPNs with the ssh Tunnel feature. Discussion will also cover tools that can extend SSH\'s power like <a href="https://mosh.org/">mosh</a> (for interactive terminals on high-latency networks), <a href="https://github.com/sshuttle/sshuttle">sshuttle</a> (a VPN when Tunnel won\'t work), and <a href="https://github.com/moul/advanced-ssh-config">advanced-ssh-config</a> (for simplifying the generation of complex .ssh/config files).',
                'talk_type' => 'Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T09' => array(
        'speaker' => array (
            array (
                'name' => 'David Hayes',
                'img' => 'David_Hayes.jpg',
                'bio' => 'Hi! I\'m David, a developer from Fort Collins, Colorado. I\'ve been working with PHP for over a decade, and does a lot of intensive backend work, a fair bit of Javascript, and dabbles with CSS sometimes. While I\'m big into WordPress, I own and run the popular development tutorial site WPShout (http://wpshout.com). I\'ve got experience with everything from old school PHP to the latest and greatest of Symfony and Laravel.',
                'twitter' => 'davidbhayes',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'WordPress Security Auditing, Applied',
                'tagline' => '',
                'talk_description' => 'I love WordPress. But WordPress sites are regularly compromised by bad code (and a lack of updates), that\'s the ugly truth of the situation. In this workshop we\'ll work to make sure that our code is never the reason that such a thing could happen. We\'ll start with a discussion of the security essentials for WordPress, and then in WP and PHP code. Then we\'ll dive into code, auditing and fixing a plugin with real and common security vulnerabilities. At the end, we\'ll gather back together and talk about what we found and what we missed.',
                'talk_type' => 'Tutorial',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T10' => array(
        'speaker' => array (
            array (
                'name' => 'Vesna Kovach',
                'img' => 'Vesna_Kovach.jpg',
                'bio' => 'Vesna Kovach lives in Columbus, Wisconsin, a historic town near Madison. She likes steampunk, retro cookery, gaming, and growing unusual vegetables.',
                'twitter' => 'vesna_v_k',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Beyond FizzBuzz: Master Job Interview Coding Challenges',
                'tagline' => '',
                'talk_description' => 'Picture this: you\'re acing a job interview, and you feel great. Then out comes the dreaded whiteboard, and you\'re faced with some off-the-wall task with no bearing to reality or sanity. Find us some palindromes! Tell us how many sewer covers there are in the city of San Francisco! Print "FizzBuzz" some of the time! Don\'t lose your cool. Most of these coding challenges fall into a few categories that you can master. Many become very easy once you realize the trick to it. In this talk, you\'ll learn about some popular challenges and how to knock them out of the park. You\'ll explore alternative methods, and find out how to impress your interviewer with your understanding of data structures and algorithms. Learn how to use unit tests to sharpen your skills. Practice the principles you learn in this talk, and you\'ll be able fly through standard job coding challenges with ease.',
                'talk_type' => 'Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T11' => array(
        'speaker' => array (
            array (
                'name' => 'Debbie Marks',
                'img' => 'Debbie_Marks.jpg',
                'bio' => 'Debbie used to be a mechanical engineer and currently works as a Licensed Marriage and Family Therapist while secretly pursuing her web development degree. In her private practice she sees people with depression and anxiety and relationship issues. She has a retirement plan to travel around the country in her motor home with her husband and do freelance web development. She attends Madison College and Madison PHP Meetup meetings. She enjoys walking and reading in her spare time.',
                'twitter' => '',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Communication Boot Camp for Developers',
                'tagline' => '',
                'talk_description' => 'Addressing conflict is one of the most difficult hurdles to overcome within the workplace. You may think, “How can I resolve this without coming off as the bad guy?” “What if the conflict is with someone at a higher level with me?” “What if the repercussions land on me?” Do you ever feel intimidated talking to that coworker? Wonder what to say at the office social? You will learn communication skills to address each of these common issues and more during this tutorial. You will have the opportunity to practice your new skills with a new friend in an encouraging environment-and you can take these skills into your personal relationships as well.',
                'talk_type' => 'Workshop',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T12' => array(
        'speaker' => array (
            array (
                'name' => 'Oscar Merida',
                'img' => 'Oscar_Merida.jpg',
                'bio' => 'Oscar still remembers downloading an early version of the Apache HTTP server at the end of 1995, and promptly asking "Ok, what\'s this good for?" He started learning PHP in 2000 and hasn\'t stopped since. He\'s worked with Drupal, WordPress, Zend Framework, Silex, and bespoke PHP, to name a few. Currently, he\'s the Editor-in-chief at php[architect]',
                'twitter' => 'omerida',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Object-oriented Programming in Practice',
                'tagline' => '',
                'talk_description' => 'It\'s easy to explain the syntax of Classes and Objects in PHP. It\'s another thing to have it all "click" and write code which is more than procedural functions written inside of a class. In this talk, we\'ll look at practical examples of using interfaces, abstract classes, and objects to write code which is conPcise, flexible, testable, and easy to maintain. If you\'re still writing procedural PHP, you\'ll come away with a better understanding of how to make the leap to thinking in an object oriented way.',
                'talk_type' => 'Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T13' => array(
        'speaker' => array (
            array (
                'name' => 'Marsha Schwanke',
                'img' => 'madison-php-logo.jpg',
                'bio' => 'Marsha Schwanke develops web projects, online training, and accessible materials for a grant-funded regional center of the Burton Blatt Institute (BBI) at Syracuse University. Her focus is maximizing access and usability based on "best practices" and established guidelines, such as the W3C Web Content Accessibility Guidelines (WCAG). Ms. Schwanke has a Bachelors in Therapeutic Recreation from Ohio University and a Masters in Information Technology from American Intercontinental University. She is a Certified Therapeutic Recreation Specialist (CTRS) and has over 30 years experience as a manager, practitioner, and volunteer working with children and adults with disabilities in hospital, long-term care, and community settings. She has authored and facilitated over 100 presentations and trainings on disability awareness, web access, and assistive technology.',
                'twitter' => '',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Web Access Jeopardy',
                'tagline' => '',
                'talk_description' => 'Ready, Set, Go! -- In this interactive session, teams of contestants will select questions from different categories about web access and accumulate points based on their response. Gain awareness and test your knowledge of concepts to help your web applications be more accessible and usable to a diverse audience.',
                'talk_type' => 'Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T14' => array(
        'speaker' => array (
            array (
                'name' => 'Hilary Stohs-Krause',
                'img' => 'Hilary_Stohs-Krause.jpg',
                'bio' => 'Hilary Stohs-Krause is currently based in Madison, WI, working as a full-stack software developer at Ten Forward Consulting. She came to tech by way of childhood website-building (a "Buffy the Vampire Slayer" fansite, to be exact). She volunteers regularly with several tech and community organizations, and co-runs Madison Women in Tech, a local group with more than 1,000 members. She tweets feminism, puns and tech at @hilarysk.',
                'twitter' => 'hilarysk',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Using our powers for good: Tech and social impact',
                'tagline' => '',
                'talk_description' => 'Want to make an impact in your community, but don\'t know how, or feel like you don\'t have time? You\'re not alone. Luckily, there are a number of ways you can use your tech-industry skills to create positive change in your community - and yourself! (Fun fact: volunteers live longer and make more money than those who don\'t volunteer.) In this talk, we\'ll look at the why\'s, the how\'s, and the where\'s for sharing our skills. You\'ll learn more about the breadth of ways to give back - both technical and non-technical - and hopefully leave feeling empowered to reach out in your own community and start making connections.',
                'talk_type' => 'Short Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T15' => array(
        'speaker' => array (
            array (
                'name' => 'Dave Stokes',
                'img' => 'DaveStokes.jpg',
                'bio' => 'Dave Stokes is a MySQL Community Manager for Oracle and has been using PHP since it was called Personal Home Page',
                'twitter' => 'stoker',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'MySQL 8 -- A New Beginning',
                'tagline' => '',
                'talk_description' => 'MySQL 5.7 was the next received version of the most popular database on the web. But now MySQL is available with many new features plus improved performance. First there is a true data dictionary to store meta data instead of a series of files that tie up inodes; the good news is that you can now have millions of tables in a schema and the bad news is that you can not have millions of tables in a schema. Common Table Expressions and Windowing Functions to make it easier to write sub-queries and to perform analytics on your data. The new scheduler handles higher data contention levels, you get rue descending indexes, UTF8MB4 support (and it is the default character set), roles, and better JSON support.',
                'talk_type' => 'Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T16' => array(
        'speaker' => array (
            array (
                'name' => 'Mike Stowe',
                'img' => 'Mike_Stowe.jpg',
                'bio' => 'Author of Undisturbed REST, Michael Stowe has spoken at conferences around the world. An active advocate for creating better architectures and interfaces, his work has also been featured on ProgrammableWeb, DZone, and InfoQ. You can view his past talks and slides <a href="https://urldefense.proofpoint.com/v2/url?u=http-3A__www.mikestowe.com_slides&d=DwIFaQ&c=fxtm8VyUXgCVDKhi9yIVsVsjq1ocZ-LZVehzdzjopw0&r=Sz7KwEWV63tbXUFw1qHuvW4Q_GjyUUK9ji78Ec60sCM&m=ws6EQ-CinmslxQXJAwgicr4-jhzrkSDiNRmBGe2T_pA&s=-fUazjLuQ6iP8PLJoskl8o2XOj3Gy3Q2P1N3LNNcLd4&e=">here</a> and follow him on Twitter @mikegstowe.',
                'twitter' => 'mikegstowe',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Call... Text... Video Me Maybe?',
                'tagline' => '',
                'talk_description' => 'Have you ever wondered how you could add voice, telephone, SMS, MMS, messaging, video, meeting, or fax (yes - I said fax) capabilities to your web app? Learn how easy it is to build in all of these with HTTP based APIs and take your application beyond the browser. For this session we\'ll focus on using the RingCentral APIs (although you can easily use any other vendor as the process is nearly the same).',
                'talk_type' => 'Tutorial',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T17' => array(
        'speaker' => array (
            array (
                'name' => 'Philipp Strazny',
                'img' => 'Philipp_Strazny.jpg',
                'bio' => 'Philipp Strazny is a translator, localizer, and web programmer and works for The Geo Group, a translation agency based in Madison. A native German, he moved to the U.S. in 1994 and now lives with his family in Manitowoc. More info at:<br>- <a href="http://www.thegeogroup.com/">The Geo Group</a> - see blog articles<br>- <a href="http://www.linkedin.com/in/philstraz">LinkedIn profile</a><br>- <a href="http://philippstrazny.blogspot.com/">private blog</a>',
                'twitter' => '',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Localizing websites',
                'tagline' => '',
                'talk_description' => 'Should I translate my website? How do I do that? How do translators work? How do I work with translators? How do I make sure that the translations are correct? These questions and more will be the focus of this presentation. We\'ll look at CMSs in general and WordPress in particular. We\'ll look at PHP\'s gettext utilities and when (NOT) to use them.',
                'talk_type' => 'Short Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T18' => array(
        'speaker' => array (
            array (
                'name' => 'Chris Tankersley',
                'img' => 'Chris_Tankersley.jpg',
                'bio' => 'Chris Tankersley is a husband, father, author, speaker, PHP developer,  podcast host, and probably lots of other things he\'s forgetting to  mention. He works for InQuest, a network security company out of  Washington, DC, but lives in Northwest Ohio where it is much colder  sometimes. Chris has worked with many different frameworks and languages  throughout his twelve years of programming, but spends most of his day  working in PHP, with a sprinkling of Python thrown in for good measure.  He is the author of "Docker for Developers," and works with companies  and developers for integrating containers into their workflows.',
                'twitter' => 'dragonmantank',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'How We Got Here, A Brief History of Open Source',
                'tagline' => '',
                'talk_description' => 'We all have a journey, a journey that shapes who and what we are. Ideals, hopes, dreams, and a constant stream of decisions helps make us who we are. The same is true of the idea of Open Source. The journey and story of Open Source has shaped the software landscape in the present and will continue to shape the direction of software into the future. As developers we should know this tale, this history, the important chapters that helped found the ideals of Open Source, and understand why PHP is one of the last truly Open Source projects still around.',
                'talk_type' => 'Keynote',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T19' => array(
        'speaker' => array (
            array (
                'name' => 'Trezy',
                'img' => 'Trezy.jpg',
                'bio' => '',
                'twitter' => 'RollForTrezy',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Simplify Your Workflow With Docker',
                'tagline' => '',
                'talk_description' => 'We\'ve all been there. You\'ve tested your application time and time again, and everything is working *perfectly*. Now all you need to do is pull the code down to your deployment server and you\'re good to go, right? **Right?** Except... you\'re not. You deploy your code, and almost immediately you get users complaining that things aren\'t working. Turns out, you forgot to install some vital packages like `imagemagick` and `bcrypt`. Womp womp. There\'s a better way. Docker allows you to transcend these issues by building the same environment every time. This talk will go through the basics of Docker, how to get started, wha\sts a Dockerfile, why not just use a VM, as well as diving into the some of the common issues that Docker can solve for PHP developers.',
                'talk_type' => 'Tutorial',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T20' => array(
        'speaker' => array (
            array (
                'name' => 'Naveen VK',
                'img' => 'Naveen_VK.jpg',
                'bio' => 'Naveen VK is a Principal Architect at NVISIA, a regional software development partner. Over the last 19 years she has designed and built custom applications using the Java Enterprise stack for industry leading companies in the finance, insurance, healthcare, manufacturing and government sectors, including the State of Wisconsin. Her projects typically include multi-tier, custom applications where she is involved in the entire application life cycle including requirements gathering, design, coding, integration, testing and deployment. In addition to coding in Java since 1997, she also has deep expertise in databases like Oracle (since 1994) and DB2 (since 1999) with SQL queries and stored procedures. She is an expert with frameworks like Spring (Core Spring, Spring Data, Spring Web Services, Spring IO, Spring AMQP, Spring Web Flow, Spring Boot) and Hibernate. She is a founder and a board member of Codecinella, a contributor to the architecture team at her current client and has earned a spot on NVISIA\'s senior leadership team. She enjoys sharing her expertise through technical talks and presentations at various meetups in Madison and Milwaukee.',
                'twitter' => 'navnoon',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Machine Learning Algorithms',
                'tagline' => '',
                'talk_description' => 'Machine learning and artificial intelligence pop up in moves and TV shows all the time, but have you ever wondered how they actually work in the real world? Do you know what a Neural Network is and why it\'s important? Join me for a high level introduction to the algorithms used in supervised and unsupervised machine learning as well as their concepts, theory, and use case examples.',
                'talk_type' => 'Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T21' => array(
        'speaker' => array (
            array (
                'name' => 'Pauline Vos',
                'img' => 'Pauline_Vos.png',
                'bio' => 'Pauline is a PHP developer currently employed by Werkspot in Amsterdam. She likes good, clean software design and being as efficient (lazy) as possible. Also cocktails, video games and animal memes. She lives in Amsterdam with her cat, Phife Cat, and about three plants.',
                'twitter' => 'vanamerongen',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Git Legit',
                'tagline' => '',
                'talk_description' => 'If you\'re fighting with Git on a regular basis, you might not be using it optimally. Many Git users tend to use Git as a save point, like in a video game; chronologically making checkpoint commits as they go. This spreads out changes to the same areas in the code over several commits, necessitates merging and resolving conflicts, and generally just makes an incomprehensible jumble of your history. This talk makes a case for atomic commits and how to use them while only minimally affecting your workflow. Using pre-recorded demos, you\'ll learn how to properly interactively rebase, fix up, reset, bisect, and more. By the end of the talk, you\'ll have seen how this Git flow will make your life easier and how it will affect your ability to cherry pick, drop unwanted commits, and most importantly: not spend hours resolving conflicts in rebase hell. A little change in habits can go a very long way!',
                'talk_type' => 'Talk',
            ),
        ),
        'display_speaker' => 'yes',
    ),
    'T22' => array(
        'speaker' => array (
            array (
                'name' => 'Justin Yost',
                'img' => 'Justin_Yost.png',
                'bio' => 'Justin is a Senior Software Engineer with Wirecutter working on building out a REST API and client app that powers the product database. Justin relishes programming, learning more about everything and anything, teaching and dislikes the Oxford comma. He is a course author for LinkedIn Learning covering topics such as; PHP, CakePHP, Ember.js, Unit Testing and REST APIs and gives talks regularly at the local PHP Meetup. In what time is left over from all that, he backpacks on occasion and enjoys a good book.',
                'twitter' => 'justinyost',
            ),
        ),
        'talks' => array(
            array (
                'title' => 'Laravel: Building APIs Like a Pro',
                'tagline' => '',
                'talk_description' => 'APIs are quickly becoming one of the primary tools developers will work on and build. Whether it\'s an API to power a JavaScript desktop front-end or a mobile app, or to be used by your customers to make the next awesome third party integration, APIs aren\'t just a tool for the big players in development spaces. They are for everyone and anyone. Together we\'ll learn how to build an API in Laravel, from the simple and basic, BREAD interface to some more complex interfaces as well as building an OAuth login and authentication system for your API.',
                'talk_type' => 'Tutorial',
            ),
        ),
        'display_speaker' => 'yes',
    ),
);

$app['sessions'] = $sessions;

// use layout templates
$app->before(function () use ($app) {
    $app['twig']->addGlobal('layout', null);
    $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig.html'));
});

// route for home page
$app->get('/', function() use($app) {
    return $app['twig']->render('pages/home.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Home',
        'conference_year' => $app['conference_year'],
    ));
});

// route for schedule
$app->get('/schedule/', function() use($app) {
    return $app['twig']->render('pages/schedule.html', array(
        'nav' => $app['nav'],
        'sessions' => $app['sessions'],
        'sponsors' => $app['sponsors'],
        'active' => 'Schedule',
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));});

// route for speakers
$app->get('/speakers/', function() use($app) {
    return $app['twig']->render('pages/speakers.html', array(
        'nav' => $app['nav'],
        'sessions' => $app['sessions'],
        'sponsors' => $app['sponsors'],
        'active' => 'Speakers',
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));});

// route for venue
$app->get('/venue/', function() use($app) {
    return $app['twig']->render('pages/venue.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Venue',
        'conference_year' => $app['conference_year'],
    ));
});

// route for hotel
$app->get('/hotel/', function() use($app) {
    return $app['twig']->render('pages/hotel.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Hotel',
        'conference_year' => $app['conference_year'],
    ));
});

// route for sponsors
$app->get('/sponsors/', function() use($app) {
    return $app['twig']->render('pages/sponsors.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Sponsors',
        'conference_year' => $app['conference_year'],
    ));
});

// route for expect
$app->get('/expect/', function() use($app) {
    return $app['twig']->render('pages/expect.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'What to Expect',
        'conference_year' => $app['conference_year'],
    ));
});

// route for organizers
$app->get('/organizers/', function() use($app) {
    return $app['twig']->render('pages/organizers.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Organizers',
        'conference_year' => $app['conference_year'],
    ));
});

// route for tickets
$app->get('/tickets/', function() use($app) {
    return $app['twig']->render('pages/tickets.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Tickets',
        'conference_year' => $app['conference_year'],
    ));
});

// route for conduct
$app->get('/conduct/', function() use($app) {
    return $app['twig']->render('pages/conduct.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Code of Conduct',
        'conference_year' => $app['conference_year'],
    ));
});

// route for the conference map
$app->get('/conference_map/', function() use($app) {
    return $app['twig']->render('pages/conference_map.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Conference Map',
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});

// routes for schedule
$app->get('/talks/T01/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T01'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T02/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T02'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T03/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T03'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T04/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T04'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T05/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T05'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T06/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T06'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T07/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T07'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T08/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T08'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T09/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T09'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T10/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T10'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T11/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T11'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T12/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T12'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T13/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T13'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T14/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T14'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T15/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T15'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T16/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T16'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T17/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T17'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T18/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T18'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T19/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T19'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T20/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T20'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T21/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T21'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T22/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T22'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T23/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'session' => $app['sessions']['T23'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});





$app->run();
