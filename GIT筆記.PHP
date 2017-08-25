<?php
0::安裝完成後，還需要最後一步設置，在命令行輸入：
git config --global user.name "ph003003"
git config --global user.email "b93thcqn@gmail.com"
因為Git是分佈式版本控制系統，所以，每個機器都必須自報家門：你的名字和Email地址。你也許會擔心，如果有人故意冒充別人怎麼辦？這個不必擔心，首先我們相信大家都是善良無知的群眾，其次，真的有冒充的也是有辦法可查的。

1::創建一個版本庫非常簡單，首先，選擇一個合適的地方，創建一個空目錄：
mkdir learngit
cd learngit
pwd
輸出--/Users/michael/learngit
pwd命令用於顯示當前目錄。在我的Mac上，這個倉庫位於/Users/michael/learngit。如果你使用Windows系統，為了避免遇到各種莫名其妙的問題，請確保目錄名（包括父目錄）不包含中文。

第二步，通過git init命令把這個目錄變成Git可以管理的倉庫：
git init
輸出--Initialized empty Git repository in /Users/michael/learngit/.git/
瞬間Git就把倉庫建好了，而且告訴你是一個空的倉庫（empty Git repository），細心的讀者可以發現當前目錄下多了一個.git的目錄，
這個目錄是Git來跟踪管理版本庫的，沒事千萬不要手動修改這個目錄裡面的文件，不然改亂了，就把Git倉庫給破壞了。
如果你沒有看到.git目錄，那是因為這個目錄默認是隱藏的，用ls -ah命令就可以看見。
因為文本是有編碼的，比如中文有常用的GBK編碼，日文有Shift_JIS編碼，如果沒有歷史遺留問題，強烈建議使用標準的UTF-8編碼，所有語言使用同一種編碼，既沒有衝突，又被所有平台所支持。

2::第一步，用命令git add告訴Git，把文件添加到倉庫：
輸入-- git add readme.txt
輸入-- git add . (此行 為 資料夾都加入)
執行上面的命令，沒有任何顯示，這就對了，Unix的哲學是“沒有消息就是好消息”，說明添加成功。
第二步，用命令git commit告訴Git，把文件提交到倉庫：
輸入-- git commit -m "wrote a readme file"
輸出--"[master (root-commit) cb926e7] wrote a readme file
 1 file changed, 2 insertions(+)
 create mode 100644 readme.txt"
 簡單解釋一下git commit命令，-m後面輸入的是本次提交的說明，可以輸入任意內容，當然最好是有意義的，這樣你就能從歷史記錄裡方便地找到改動記錄。
git commit命令執行成功後會告訴你，1個文件被改動（我們新添加的readme.txt文件），插入了兩行內容（readme.txt有兩行內容）。
為什麼Git添加文件需要add，commit一共兩步呢？因為commit可以一次提交很多文件，所以你可以多次add不同的文件，比如：
 git add file1.txt
 git add file2.txt file3.txt
 git commit -m "add 3 files."
要隨時掌握工作區的狀態，使用git status命令。
如果git status告訴你有文件被修改過，用git diff可以查看修改內容。

3::HEAD指向的版本就是當前版本，因此，Git允許我們在版本的歷史之間穿梭，使用命令git reset --hard commit_id。
上一個版本就是HEAD^，上上一個版本就是HEAD^^，當然往上100個版本寫100個^比較容易數不過來，所以寫成HEAD~100。
穿梭前，用git log可以查看提交歷史，以便確定要回退到哪個版本。
要重返未來，用git reflog查看命令歷史，以便確定要回到未來的哪個版本。
現在，你又理解了Git是如何跟踪修改的，每次修改，如果不add到暫存區，那就不會加入到commit中。

4::Windows下打開Git Bash，創建SSH Key：
$ ssh-keygen -t rsa -C "youremail@example.com"
你需要把郵件地址換成你自己的郵件地址，然後一路回車，使用默認值即可，由於這個Key也不是用於軍事目的，所以也無需設置密碼。
如果一切順利的話，可以在用戶主目錄裡找到.ssh目錄，裡面有id_rsa和id_rsa.pub兩個文件，這兩個就是SSH Key的秘鑰對，id_rsa是私鑰，不能洩露出去，id_rsa.pub是公鑰，可以放心地告訴任何人。
第"2"步：登陸GitHub，打開“Account settings”，“SSH Keys”頁面：
然後，點“Add SSH Key”，填上任意Title，在Key文本框裡粘貼id_rsa.pub文件的內容：

登陸GitHub，然後，在右上角找到“Create a new repo”按鈕，創建一個新的倉庫：
在Repository name填入learngit，其他保持默認設置，點擊“Create repository”按鈕，就成功地創建了一個新的Git倉庫：
目前，在GitHub上的這個learngit倉庫還是空的，GitHub告訴我們，可以從這個倉庫克隆出新的倉庫，也可以把一個已有的本地倉庫與之關聯，然後，把本地倉庫的內容推送到GitHub倉庫。

現在，我們根據GitHub的提示，在本地的learngit倉庫下運行命令：
$ git remote add origin git@github.com:ph003003/coding_study_note.git
添加後，遠程庫的名字就是origin，這是Git默認的叫法，也可以改成別的，但是origin這個名字一看就知道是遠程庫。
下一步，就可以把本地庫的所有內容推送到遠程庫上：
$ git push -u origin master
把本地庫的內容推送到遠程，用git push命令，實際上是把當前分支master推送到遠程。
由於遠程庫是空的，我們第一次推送master分支時，加上了-u參數，Git不但會把本地的master分支內容推送的遠程新的master分支，
還會把本地的master分支和遠程的master分支關聯起來，在以後的推送或者拉取時就可以簡化命令。
推送成功後，可以立刻在GitHub頁面中看到遠程庫的內容已經和本地一模一樣：
從現在起，只要本地作了提交，就可以通過命令：
$ git push origin master
把本地master分支的最新修改推送至GitHub，現在，你就擁有了真正的分佈式版本庫！

5::從遠程庫克隆
上次我們講了先有本地庫，後有遠程庫的時候，如何關聯遠程庫。
現在，假設我們從零開發，那麼最好的方式是先創建遠程庫，然後，從遠程庫克隆。
首先，登陸GitHub，創建一個新的倉庫，名字叫git_name：
我們勾選Initialize this repository with a README，這樣GitHub會自動為我們創建一個README.md文件。創建完畢後，可以看到README.md文件：
現在，遠程庫已經準備好了，下一步是用命令git clone克隆一個本地庫：
$ git clone git@github.com:ph003003/git_name.git
$ cd git_name(上一行所創目錄)
$ ls
README.md
注意把Git庫的地址換成你自己的，然後進入git_name目錄看看，已經有README.md文件了。
 如果有多個人協作開發，那麼每個人各自從遠程克隆一份就可以了。
你也許還注意到，GitHub給出的地址不止一個，還可以用https://github.com/michaelliao/gitskills.git這樣的地址。實際上，Git支持多種協議，默認的git://使用ssh，但也可以使用https等其他協議。
使用https除了速度慢以外，還有個最大的麻煩是每次推送都必須輸入口令，但是在某些只開放http端口的公司內部就無法使用ssh協議而只能用https。
?>