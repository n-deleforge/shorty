        <div id="footer"><?php echo LANGUAGE["footer"]; ?></div>
    </div>
    
    <script>
    <?php
    if (PAGENAME === "auth" || PAGENAME === "settings")
        echo 'deleteInfo();';
    if (PAGENAME === "list")
        // echo 'deleteInfo(); copyToClipboard(document.querySelectorAll(".clipboard"));';
    if (PAGENAME === "add" || PAGENAME === "modify")
        echo 'deleteInfo(); checkRegex();';
    ?>
    </script>
</body>
</html>