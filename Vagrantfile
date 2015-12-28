require 'json'
require 'yaml'

VAGRANTFILE_API_VERSION ||= '2'
confDir = $confDir ||= File.expand_path('vendor/laravel/homestead', File.dirname(__FILE__))

homesteadYamlPath = 'Homestead.yaml'
homesteadJsonPath = 'Homestead.json'
afterScriptPath = 'after.sh'
aliasesPath = 'aliases'

require File.expand_path(confDir + '/scripts/homestead.rb')

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.provider 'virtualbox' do |vb|
    vb.linked_clone = true
    vb.customize ['modifyvm', :id, '--paravirtprovider', 'kvm']
  end

  if File.exist? aliasesPath
    config.vm.provision 'file', source: aliasesPath, destination: '~/.bash_aliases'
  end

  if File.exist? homesteadYamlPath
    Homestead.configure(config, YAML.load(File.read(homesteadYamlPath)))
  elsif File.exist? homesteadJsonPath
    Homestead.configure(config, JSON.parse(File.read(homesteadJsonPath)))
  end

  if File.exist? afterScriptPath
    config.vm.provision 'shell', path: afterScriptPath
  end
end
