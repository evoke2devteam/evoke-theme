# evoke-theme

Theme based on Adaptable for moodle

##### Installing a new theme
1. Upload the folder containing the theme files in the themes folder of the Moodle installation
2. Enter the moodle administration panel
3. Go to Site administration -> Notifications to see if the new theme requires any decisions or updating of Moodle code
4. To select the installed theme go to *Site administration -> Appearance -> Themes -> Theme selector*, click on "Change theme" button and click on "Use theme" button.
5. To update theme properties go to *Site administration -> Appearance -> Themes -> Adaptable -> Import / Export Settings*, copy the contents of the ```properties.txt``` file and paste it in the "Import properties" field in the "Import properties" section and finally click on "Save changes" button.
6. To synchronize the super powers graph find on the profile page open the file profile.php find at:

    ```/var/www/html/Moodle/themes/theme-folder/layout/profile.php```

    Change the id of each superpower once the competency framework has been created. The change must be made on lines 43, 48, 53, 58, 70, 72, 74 and 76.
