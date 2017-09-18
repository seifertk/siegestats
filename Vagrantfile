# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "ubuntu/xenial64"

  # Forward port 8000 to share http
  config.vm.network :forwarded_port, guest: 80, host: 8000
  # forward port 3000 to share browsersync
  # config.vm.network :forwarded_port, guest: 3000, host: 3000
  config.ssh.forward_agent = true

  # Virtualbox specific configuration
  # Enable 2 cores for the virtual machine
  config.vm.provider :virtualbox do |virtualbox, override|
    # Modify the vm's allocated ram
    virtualbox.memory = 1024
    # Set permissions to 777 to fix errors
    override.vm.synced_folder ".", "/vagrant", :mount_options => ["dmode=777","fmode=777"]
  end

  # set the hostname of the vagrant machine, for ansible inventory
  config.vm.define "vagrant"

  config.vm.provision :ansible_local do |ansible|
    ansible.playbook = "lib/ansible/playbook.yml"
    # we can specify variables here, which  will take highest priority
    # this saves us from needing to modify vars/vars.yml directly
    ansible.extra_vars = {
        php_version: "7.1",
        database: "siege_stats",
        mysql_root_password: "password"
    }
  end

end
