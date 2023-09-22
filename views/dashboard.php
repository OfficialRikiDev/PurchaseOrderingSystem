<link rel="stylesheet" href="/css/dashboard.css">

<main class="container">
    <div class="menu">
        <div class="avatar">
            <img class="thumb" src="https://source.boringavatars.com/pixel/120/<?php echo $_SESSION['username']; ?>?colors=26a653,2a1d8f,79646a" width="60" />

            <span class="name">@<?php echo $_SESSION['username']; ?></span>
        </div>
        <nav class="primary">
            <a href="#" class="menu-item active">
                <span class="iconoir-report-columns"></span>
                <span class="desc">Dashboard</span>
            </a>
            <a href="#" class="menu-item">
                <span class="iconoir-google-docs"></span>
                <span class="desc">Reports</span>
            </a>
            <a href="#" class="menu-item">
                <span class="iconoir-table"></span>
                <span class="desc">Stats</span>
            </a>
            <a href="#" class="menu-item">
                <span class="iconoir-bag"></span>
                <span class="desc">Cart</span>
            </a>
            <a href="#" class="menu-item">
                <span class="iconoir-user"></span>
                <span class="desc">Clients</span>
            </a>
            <a href="#" class="menu-item">
                <span class="iconoir-leaderboard"></span>
                <span class="desc">Analytics</span>
            </a>
            <a href="#" class="menu-item">
                <span class="iconoir-settings"></span>
                <span class="desc">Settings</span>
            </a>
            <a href="/logout.php" class="menu-item">
                <span class="iconoir-log-out"></span>
                <span class="desc">Logout</span>
            </a>
        </nav>
        <span class="expander iconoir-arrow-right"></span>
    </div>
    <div class="topbar">
        <h1 class="current">Dashboard</h1>
        <span class="search">
            <label><span class="iconoir-search"></span></label>
            <input class="bar" type="text" placeholder="Search..." />
        </span>
        <nav>
            <a href="#" class="menu-item">Orders</a>
            <a href="#" class="menu-item">Clients</a>
            <a href="#" class="menu-item">Sections</a>
            <a href="#" class="menu-item">Products</a>
        </nav>
    </div>
    <div class="dashboard">
        <div class="cardNumbers">
            <div class="card">
                <header>
                    <a class="title" href="#">Total Suppliers</a>
                </header>
                <div class="content bg-opacity-30 rounded-lg bg-green-200 border border-green-300 h-50">100</div>
            </div>
            <div class="card">
                <header>
                    <a class="title" href="#">Total Items</a>
                </header>
                <div class="content bg-opacity-30 rounded-lg bg-red-200 border border-red-300 h-50">1,500</div>
            </div>
            <div class="card">
                <header>
                    <a class="title center" href="#">Idk?</a>
                </header>
                <div class="content bg-opacity-30 rounded-lg bg-blue-200 border border-blue-300 h-50">300</div>
            </div>
        </div>
        <div class="cardcolumn">
            <div class="card random">
                <header>
                    <a class="title" href="#"></a>
                    <span class="iconoir-more-vert"></span>
                </header>
                <div class="content"></div>
                <div class="meta">
                    <span class="iconoir-pin"></span>
                    <span class="iconoir-eye-off"></span>
                    <span class="iconoir-share-ios"></span>
                </div>
            </div>
        </div>
        <div class="cardcolumn">

            <div class="card random">
                <header>
                    <a class="title" href="#"></a>
                    <span class="iconoir-more-vert"></span>
                </header>
                <div class="content"></div>
                <div class="meta">
                    <span class="iconoir-pin"></span>
                    <span class="iconoir-eye-off"></span>
                    <span class="iconoir-share-ios"></span>
                </div>
            </div>
        </div>
        <div class="cardcolumn">

            <div class="card random">
                <header>
                    <a class="title" href="#"></a>
                    <span class="iconoir-more-vert"></span>
                </header>
                <div class="content"></div>
                <div class="meta">
                    <span class="iconoir-pin"></span>
                    <span class="iconoir-eye-off"></span>
                    <span class="iconoir-share-ios"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="side">
        <div class="card weather">
            <img class="condition" src="https://user-images.githubusercontent.com/30212452/203724734-5f748507-7ae4-49f9-89f8-7fce3112cd95.png" />
            <div class="content"></div>
            <div class="meta">
                <span class="location">


                </span>
                <div class="datetime">
                    <span class="iconoir-calendar"></span>
                    <span class="date"></span>
                    <span class="time"></span>
                </div>
            </div>
        </div>
        <div class="card">
            <header>Schedule</header>
            <div class="content">
                <ul>
                    <li>(15:30) Deliver the project to client</li>
                    <li>(18:00) Meet Mike @ White Goose</li>
                    <li>(19:30) Dinner with Mary @ Kit-Bar</li>
                    <li>(22:00) Watch the Falcons match</li>
                    <li>(23:30) Headspace Meditate</li>
                </ul>
            </div>
        </div>
    </div>
</main>
<div class="video">
    <video src="https://user-images.githubusercontent.com/30212452/203724691-9e93bf50-df02-4034-9743-dfe32d18bf58.mp4" muted playsinline autoplay loop></video>
</div>

<script src="/js/dashboard.js"></script>