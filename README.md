# Rainbow Six Siege: Stats

## Getting Started On Windows
Install Vagrant: https://releases.hashicorp.com/vagrant/2.0.0/vagrant_2.0.0_x86_64.msi

Copy `.env.example` to `.env` and modify it as needed. Typically you need to
change the database name to something sensible that matches what's in the
virtual environment.

Run `vagrant up` to install & provision the virtual environment.

## Common Vagrant commands:
- `vagrant up` initializes your virtual dev environment
- `vagrant down` halts the environment
- `vagrant reload` restarts the environment
- `vagrant provision` will run Ansible on the environment to install necessary software
- `vagrant destroy` will delete the environment
- `vagrant ssh` will open a shell inside the environment

## Common Laravel Commands
- `php artisan` will list the available commands
- `php artisan migrate` will commence database migrations
- `php artisan migrate:refresh` will reverse and re-run migrations
- `php artisan db:seed` will run any database seeders

## Typical Workflow
1. Check out a feature branch
2. Write code.
3. Perform Laravel commands inside your virtual environment via `vagrant ssh`
4. Submit a pull request.
5. Merge your code into the master branch.
