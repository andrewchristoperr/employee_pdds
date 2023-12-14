<div class="d-flex flex-column flex-shrink-0 sidebar-wrap">
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="a.php" class="nav-link" aria-current="page">
                <div class="icon-wrap">
                    <i class="fas fa-star"></i>
                </div>
                <span>Rating</span>
            </a>
        </li>
        <li>
            <a href="b.php" class="nav-link">
                <div class="icon-wrap">
                    <i class="fas fa-thumbs-up"></i>
                </div>
                <span>Satisfaction</span>
            </a>
        </li>
        <li>
            <a href="c.php" class="nav-link">
                <div class="icon-wrap">
                    <i class="fas fa-users"></i>
                </div>
                <span>Training</span>
            </a>
        </li>
        <li>
            <a href="d.php" class="nav-link">
                <div class="icon-wrap">
                    <i class="fas fa-comment-dollar	"></i>
                </div>
                <span>Desired Salary</span>
            </a>
        </li>
        <li>
            <a href="e.php" class="nav-link">
                <div class="icon-wrap">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <span>Salary</span>
            </a>
        </li>
    </ul>
    <hr>
</div>

<script>
    // Get the current URL
    var currentUrl = window.location.href;

    // Get all the nav links
    var navLinks = document.querySelectorAll('.nav-link');

    // Loop through each nav link
    navLinks.forEach(function(link) {
    // Get the href attribute of the link
    var linkUrl = link.getAttribute('href');
    // Check if the current URL matches the link URL
    if (currentUrl.indexOf(linkUrl) !== -1) {
        // Add the active class to the link
        link.classList.add('active');
    }
    });
</script>