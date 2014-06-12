default_run_options[:pty] = true

set :application, "RocketChef"
set :domain,      "s526317483.onlinehome.fr"
set :deploy_to,   "rocketchef"
set :app_path,    "app"
set :user,        "u77128745"

set :deploy_via, :copy
set :copy_remote_dir, deploy_to

set :branch, "master"
set :scm,         :git
set :repository,  "https://github.com/shked0wn/RocketChef"


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