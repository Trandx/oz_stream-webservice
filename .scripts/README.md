we first need to generate a new ssh key pair on our server.
    Run this command on your server to generate the ssh keys.

    ``$ ssh-keygen -t rsa -b 4096 -C "dev@oz-medias.com"``

This will create 2 ssh keys, public and private inside your home directory .ssh/ folder.

And now add your newly generated ssh private key to the ssh-agent with the following commands.

    ``$ eval "$(ssh-agent -s)" && ssh-add ~/.ssh/id_rsa``

And let's add our public key to the authorized_keys file on our server with the following command.

    ``$ cat ~/.ssh/id_rsa.pub >> ~/.ssh/authorized_keys``

Copying ssh keys to Github

In GitHub, go on the project, click on settings > options > secrets > "new repository secret"
Then add:

    HOST
    PORT
    SSHKEY (copy the key that is inside /.ssh/id_rsa)
    USERNAME (this value will get when we type commande "whoami" inside the remote server)
    PRODUCTION_DIR
    STAGING_DIR

Our server to authenticate to Github and fetch the latest commits on our repository.
In GitHub, go on the project, click on settings > options > "Deploy keys" > "Add deploy key"
Fill all fields an click on "Add key"

And for the key field value go to your server and print your public key with the following command and copy it.

    ``$ cat ~/.ssh/id_rsa.pub``

Then on your server go to your deployed application directory, most commonly inside (Eg: "/var/html/www") and run the following command.

    ``git remote set-url origin "git@github.com:USERNAME/REPOSITORY.git" && git fetch``
