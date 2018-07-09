# TempFiles
Please forgive me for my English

What is this library for? With it you can create some "temporary" files in which you can store any data. You can group, modify, delete these files. All data is stored in json format.

Immediately, what are groups? The group is an Association of multiple files. A file in a group can be named in the same way as a file without a group, or a file from another group.

All functions are called as: Temp:: function()
Example: Temp::saveTempFile('o', 'op');

Functions:
1) saveTempFile(file name, file content, group[optional]);
This function creates a file with the content you have specified. If the file already exists, it is overwritten. If you specify a group, the file will be created / modified only in this group. If there is no specified group, then this file will not have it.

2) delTempFile (file name, group[optional])
This feature deletes the file with the name you specified. If you specify a group, the file will be removed from this group.

3) delTempGroup(group name);
This function deletes the group with all files included in it.

4)getTempFile(file, group);
This function returns the specified file. If the group is specified.

5)getTempGroup(group);
This function returns the entire group you specify.

6) delAll(mode);
This function deletes temporary files.
If groups is specified, all groups will be deleted, if files, then all files not included in groups will be deleted, if all, then all will be deleted.

On the third line of the TempFiles file.php you can configure the path from the root of the site, to the temp folder, which will store all temporary files.

On the seventh line, you can change the name of the folder where the temporary files will be stored.
