namespace :phpfpm do

  task :reload do
    on roles(:app) do |host|
      info "Reloading php-fpm"

      execute :sudo, "service php7.1-fpm reload"
    end
  end

end
