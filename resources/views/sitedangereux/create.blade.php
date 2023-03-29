<x-navbar>
    <div class="w-full max-w-md mx-auto">
        <form class="bg-white shadow-md rounded px-8 pb-8 mt-28">
            <div class="text-center">Ajout d'un site</div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="adresse">
                    Adresse
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="adresse" type="text">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <input class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Image
                </label>
                <input class="w-full py-2 px-3" id="image" type="file" name="image"  accept="image/*"  max-file-size="1024">
                <?php
                        if (isset($_FILES["image"])) {
                            echo "test";
                            list($largeur, $hauteur) = getimagesize($_FILES["image"]["tmp_name"]);
                            if ($largeur > 1024 || $hauteur > 1024) {
                                echo "Les dimensions sont trop élevés.";
                                exit;
                            }
                        } else {
                            echo "pas d'image";
                        }
                        var_dump($_FILES);
                ?>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</x-navbar>
