<?php include_once './includes/header.inc.php'?>



<div class="p-8 flex flex-col gap-10">

    <div>
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">My files</h2>
    </div>

    <div class="flex gap-4">

        <div class="flex flex-col gap-2 w-48 bg-gray-100 relative">
            
            <div class="dropdown self-end" data-dropdown>
                <button data-dropdown-button class="flex items-center justify-center hover:cursor-pointer bg-transparent w-5 h-5 hover:bg-gray-200 rounded-full mr-2 mt-2">
                    <i class="fa-solid fa-ellipsis-vertical pointer-events-none"></i>
                </button>
    
                <div class="dropdown-menu bg-gray-100 rounded-md w-32 absolute right-1 top-8 hidden">
                    <button class="flex items-center gap-1 hover:bg-gray-200 p-3 w-full"><i class="fa-solid fa-eye"></i> View</button>
                    <button class="flex items-center gap-1 hover:bg-gray-200 p-3 w-full"><i class="fa-solid fa-download"></i> Download</button>
                </div>
            </div>

            
            
            <img class="w-full" src="<?= HOME . "/files/qr-code.jpg" ?>" alt="">
            <div class="p-2 flex justify-between items-center">
                <p>filename</p>
                <p class="text-xs">PNG</p>
            </div>
        </div>

    </div>

</div>













<?php include_once './includes/footer.inc.php'?>
