#!/usr/bin/env ruby
require "rubygems"
require "net/ssh"
require "net/scp"

hostname = "mystique.dreamhost.com"
username = "pxlflu"
password = "songokuh"

Net::SSH.start(hostname, username, :password => password) do|ssh|
	ssh.scp.upload!('.', './23b.it', :recursive => true) do|ch, name, sent, total|
		print "\r#{name}: #{(sent.to_f * 100 / total.to_f).to_i}"
	end
end