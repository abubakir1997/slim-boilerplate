# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|

  config.vm.define 'slim' do |slim|
    slim.vm.box = 'ubuntu/trusty64'
    slim.vm.hostname = 'slim'
    
    slim.vm.network 'private_network', ip: '192.168.33.10'
    slim.vm.network 'forwarded_port', guest: 80, host: 8888
    slim.vm.network 'forwarded_port', guest: 3306, host: 8889

    slim.vm.provision 'shell' , path: './Vagrant.sh'
  end

end
