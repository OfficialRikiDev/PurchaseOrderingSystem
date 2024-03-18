<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/full.min.css" rel="stylesheet" type="text/css" />
    <script src="/js/tailwind.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <title>TransTrack</title>
</head>

<body class="antialiased scroll-smooth text-white bg-gray-950">
    <nav class="
        flex flex-wrap
        items-center
        justify-between
        w-full
        py-4
        md:py-2
        px-4
        text-lg
        fixed top-0 left-0 right-0
        top-0 
        bg-gray-900
        ">
        <div class = "pointer-events-none">
            <a href="/">
                <img class="md:ms-40 py-3" src="/assets/elpardologo.png" width="50">
            </a>
        </div>

        <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
            <ul class="
            pt-4
            text-base
            py-2
            md:flex
            md:justify-between
            gap-4
            me-40 
            md:pt-0">
                <li>
                    <a class="md:p-4 py-2 block hover:text-blue-400" href="#">About</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block hover:text-blue-400" href="/portal">Portal</a>
                </li>
            </ul>
        </div>
    </nav>
    <section class="w-full justify-center" style="background: #010336">
        <div class="items-center text-center pt-40 pb-24 sm:pb-44 sm:pt-56">
            <h1 class="title-font sm:text-8xl text-6xl mb-4 font-medium">TRANSTRACK</h1>
            <span>The purchasing solution you've been searching for.</span>
        </div>
    </section>

    <section class="pt-4 pb-12 text-black">
        <div class="px-5 sm:px-10 md:px-20 lg:px-10 xl:px-20 py-8" id="features">
            <div class="max-w-screen-xl mx-auto">
                <h3 class="leading-none font-black text-3xl text-gray-300">
                    Features
                </h3>

                <div class="flex flex-col items-center flex-wrap lg:flex-row lg:items-stretch lg:flex-no-wrap lg:justify-between">
                    <div class="w-full max-w-sm mt-6 lg:mt-8 bg-gray-100 rounded shadow-lg p-12 lg:p-8 lg:mx-4 xl:p-12">
                        <div class="p-4 inline-block bg-indigo-200 rounded-lg">
                            <svg class="text-indigo-500 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 14s1.5 2 4 2 4-2 4-2" />
                                <line x1="9" y1="9" x2="9.01" y2="9" />
                                <line x1="15" y1="9" x2="15.01" y2="9" />
                            </svg>
                        </div>
                        <div class="mt-4 font-extrabold text-2xl">
                            Semi-automated
                        </div>
                        <div class="text-sm">
                        Rest assured, our semi-automated system is designed to ensure quality every step of the way. We personally vet every designer to ensure they meet our high standards, so you can trust that you're working with top-notch talent every time.
                        </div>
                    </div>

                    <div class="w-full max-w-sm mt-8 bg-gray-100 rounded shadow-lg p-12 lg:p-8 lg:mx-4 xl:p-12">
                        <div class="p-4 inline-block bg-green-200 rounded-lg">
                            <svg class="text-green-500 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                            </svg>
                        </div>
                        <div class="mt-4 font-extrabold text-2xl">
                            Budget Management
                        </div>
                        <div class="text-sm">
                        Effective budget management is the cornerstone of financial success. By prioritizing spending, tracking expenses diligently, and making informed decisions, you pave the way for stability and growth.
                        </div>
                    </div>

                    <div class="w-full max-w-sm mt-8 bg-gray-100 rounded shadow-lg p-12 lg:p-8 lg:mx-4 xl:p-12">
                        <div class="p-4 inline-block bg-red-200 rounded-lg">
                            <svg class="text-red-500 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path xmlns="http://www.w3.org/2000/svg" d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                                <line xmlns="http://www.w3.org/2000/svg" x1="12" y1="9" x2="12" y2="13" />
                                <line xmlns="http://www.w3.org/2000/svg" x1="12" y1="17" x2="12.01" y2="17" />
                            </svg>
                        </div>
                        <div class="mt-4 font-extrabold text-2xl">
                            Stock Level Protection
                        </div>
                        <div class="text-sm">
                        Stock level protection safeguards your inventory and ensures continuity of operations. By maintaining optimal stock levels, you mitigate the risk of stockouts or overstocking, enabling smoother operations and satisfied customers.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-gray-400 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="inline-block w-8 h-8 text-gray-400 mb-8" viewBox="0 0 975.036 975.036">
                    <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                </svg>
                <p class="leading-relaxed text-lg">The first rule of any technology used in a business is that automation applied to an efficient operation will magnify the efficiency. The second is that automation applied to an inefficient operation will magnify the inefficiency.</p>
                <span class="inline-block h-1 w-10 rounded bg-indigo-500 mt-8 mb-6"></span>
                <h2 class="text-gray-200 font-medium title-font tracking-wider text-sm">Bill Gates</h2>
                <p class="text-gray-500">Former CEO of Microsoft</p>
            </div>
        </div>
    </section>

    <section class="bg-indigo-950">
        <div class="container mx-auto px-6 text-center py-20">
            <h2 class="mb-6 text-4xl font-bold text-center text-white">
                BE PART OF TRANSTRACK NOW!
            </h2>
            <h3 class="my-4 text-2xl text-white">
                Want to be one of the suppliers?
            </h3>
            <button class="bg-white font-bold rounded-full mt-6 py-4 px-8 shadow-lg uppercase text-black">
                Apply now
            </button>
        </div>
    </section>

    <footer class="px-5 sm:px-10 md:px-20 py-8 bg-gray-900">
        <div class="flex flex-col items-center lg:flex-row-reverse justify-between">
            <div class="">
                <a class="mx-4 text-sm font-bold text-indigo-600 hover:text-indigo-800" href="#">Home</a>
                <a class="mx-4 text-sm font-bold text-indigo-600 hover:text-indigo-800" href="#">About</a>
                <a class="mx-4 text-sm font-bold text-indigo-600 hover:text-indigo-800" href="#">Admin</a>
                <!-- <a href="#">About Us</a> -->
                <!-- <a href="#">Careers</a> -->
            </div>
            <div class="mt-4">
                <img src="" class="w-32">
            </div>
            <div class="mt-4 text-xs font-bold text-gray-500">
                &copy; 2024 TRANSTRACK | CEBU TECHNOLOGICAL UNIVERSITY - MAIN
            </div>
        </div>
    </footer>

</body>

</html>