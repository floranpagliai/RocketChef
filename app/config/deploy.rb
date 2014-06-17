default_run_options[:pty] = true
set :php_bin, "php6"

set :application, "RocketChef"
set :domain,      "s526317483.onlinehome.fr"
set :deploy_to,   "~/rocketchef"
set :app_path,    "app"
set :user,        "u77128745"

set :scm,         :git
set :repository,  "https://f626ce180918c8816226d2cb98af21c169238ed6:@github.com/shked0wn/RocketChef.git"
ssh_options[:forward_agent] = true

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :use_sudo,      false
set  :keep_releases,  3



# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL

set :shared_files, ["app/config/parameters.yml"] # Les fichiers à conserver entre chaque déploiement
set :shared_children, [app_path + "/logs", "vendor"] # Idem, mais pour les dossiers
set :use_composer, true
set :update_vendors, false

task :php_bin do
  try_sudo  "alias php='php6' && alias"
end

after "deploy", "php_bin"

after "deploy:update", "deploy:cleanup"