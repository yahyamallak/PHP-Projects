<?php include_once ('./includes/header.inc.php') ?>

        <main class="p-5 flex flex-col gap-2">

        <form class="flex gap-5" action="generate.php" method="post" enctype="multipart/form-data">
            <div class="flex flex-col gap-4">
                <div>
                    <textarea name="text" class="resize-none w-full h-40 p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" placeholder="Enter your text"></textarea>
                    <p><em class="text-customRed"><?= $_SESSION["errors"]["text"] ?? ""; ?></em></p>
                </div>

                <div>
                    <label for="size">Size :</label>
                    <input name="size" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="number" id="size" placeholder="100px">
                </div>

                <div>
                    <label for="margin">Margin :</label>
                    <input name="margin" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="number" id="margin" placeholder="100px">
                </div>

                <div>
                    <label for="foreground">Foreground color :</label>
                    <input name="foreground" type="color" id="foreground">
                </div>

                <div>
                    <label for="background">Background color :</label>
                    <input name="background" type="color" id="background" value="#ffffff">
                </div>

                <div>
                    <label for="label">Label :</label>
                    <input name="label" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="text" placeholder="Your label...">
                </div>

                <div>
                    <label for="labelColor">Label color :</label>
                    <input name="labelColor" type="color" id="labelColor">
                </div>

                <div>
                    <select name="position" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" id="position">
                        <option value="">Choose label position</option>
                        <option value="right">Right</option>
                        <option value="center">Center</option>
                        <option value="left">Left</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <div>
                    <label for="logo">Logo :</label>
                    <input name="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-softBlue file:text-white hover:file:bg-blue-600 transition duration-300 ease-in-out cursor-pointer" type="file" id="logo">
                </div>

                <div>
                    <label for="width">Resize logo :</label>
                    <input name="width" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" type="number" id="width" placeholder="100px">
                </div>

                <div>
                    <select name="type" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" id="type">
                        <option value="">Choose file type</option>
                        <option value="png">PNG</option>
                        <option value="pdf">PDF</option>
                        <option value="svg">SVG</option>
                        <option value="webp">WebP</option>
                    </select>
                </div>


                <div>
                    <select name="errorCorrectionLevel" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-softBlue focus:border-softBlue hover:border-softBlue transition duration-300 ease-in-out" id="errorCorrection">
                        <option value="">Choose error correction level</option>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="quartile">Quartile</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <button type="submit" class="bg-softBlue text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition duration-300 ease-in-out">Generate</button>
            </div>

        

        </form>
        </main>

        <div class="flex justify-center items-center bg-gray-100">
            <div class="flex flex-col gap-4">

                <div class="border-8">
                    <img width="300" src="<?= $_SESSION["file"] ?? HOME . "/files/qr-code.jpg"; ?>" alt="">
                </div>

                
                <ul>
                    <li>
                    <?php if (isset($_SESSION["file_size"])) {
                            echo "File size : " . $_SESSION["file_size"];
                        }
                    ?>
                    </li>

                    <li>
                    <?php if(isset($_SESSION["file_width"])) {
                        echo "File width : " . $_SESSION["file_width"] . " X " . $_SESSION["file_width"]; 
                    } 
                    ?>
                    </li>

                    <li>
                    <?php if(isset($_SESSION["file_type"])) {
                        echo "File type : " . $_SESSION["file_type"]; 
                    } 
                    ?>
                    </li>
                </ul>
                    
                <?php if(isset($_SESSION["download"])): ?>
                
                    <a class="self-center" href="<?= $_SESSION["file"] ?? ''; ?>" Download="qr-code">
                    <button class="bg-softBlue text-white font-bold py-2 px-6 rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 ease-in-out flex items-center gap-1">   
                    <i class="fa-solid fa-download"></i>Download
                    </button>
                </a>

                <?php endif; ?>

            </div>
        </div>

<?php include_once './includes/footer.inc.php'?>

    
