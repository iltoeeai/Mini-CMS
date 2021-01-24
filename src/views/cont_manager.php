<?php
session_start();
require 'src/views/includes/header.php';

if ($_SESSION['valid']) {
    echo '<h2 class="display-5 mt-3 mb-3">Content Manager </h2>';

    // Add new page
    if (isset($_POST['new_page'])) {
        if (isset($_POST['new_page'])) {
            $page = new Page();
            $page->setTitle($_POST['page_name']);
            $page->setContent($_POST['content']);
            $entityManager->persist($page);
            $entityManager->flush();
            Header('Location: cont_manager');
        } 
    }

    // Update
    if (isset($_POST['update'])) {
        
            $page = $entityManager->find('Page', $_POST['id']);
            $page->setTitle($_POST['page_name']);
            $page->setContent($_POST['content']);
            $entityManager->flush();
            Header('Location: cont_manager');
        
    }


    // Delete
    if (isset($_POST['delete'])) {
        $page = $entityManager->find('Page', $_POST['id']);
        $entityManager->remove($page);
        $entityManager->flush();
        Header('Location: cont_manager');
    }

    echo '<button class="btn btn-primary mb-5"><a class="text-white" 
    href="new_page">Add Page</a></button>';

    //table of pages
    //$pages = $entityManager->getRepository('Page')->findAll();
    if ($pages) {
        echo '<table class="table table-bordered table-hover">';
        echo '<tbody>';

        foreach ($pages as $page) {
            $title = $page->getTitle();
            $id = $page->getId();
            if ($title === 'Home') {  // Home page can't be deleted
                echo '<tr class="text-center table-light"><th scope="row"><p style="font-size: 18px"> ' 
                . $title . '</p><td></td><td class="text-center"><form action="update" 
                method="POST"> <input type="hidden" name="id" value="' 
                . $id . '"><button type="submit" class="btn btn-info">Update Home Page
                </a></form></td></tr>';
            } else {
                echo ' <tr class="table-light text-center"><th scope="row"><p style="font-size: 18px"> ' 
                . $title . '</p> </th><td class="text-center"><form action="cont_manager" 
                method="POST"><input type="hidden" name="id" value="' 
                . $id . '"><input type="hidden" name="title" value=' 
                . $title . '><input type="hidden" name="delete" 
                value="y"><button type="submit" class="btn btn-danger">Delete Page
                </button></form></td><td class="text-center"><form action="update" method="POST">
                <input type="hidden" name="id" value="' . $id . '">
                <button type="submit" class="btn btn-info">Update Page</a>
                </form></td></tr>';
            }
        }
        echo '</tbody></thead></table>';
    }
}
require 'includes/footer.php';
