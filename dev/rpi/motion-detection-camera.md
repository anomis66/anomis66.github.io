# Raspberry Pi 3 Motion Detection Camera With Live Feed by ssandbac in raspberry-pi

## Introduction

In this project, you will learn how to build a motion detection camera that you will be able to use as a camera trap, a pet/baby monitor, a security camera, and much more.

This Project is organized into Several steps:

Introduction
Setting up your Pi
SSHing into your Pi
Emailing Your IP address on boot
Installing and setting up Motion
Emailing Videos from Motion on detection
Troubleshooting and Sources
What you'll need:

 * A Raspberry Pi 3 model b ~~$35
 * 8gb Micro SD card ~~$10
 * USB Webcam ~~$20 (this project used a Logitech HD Webcam c270)
 * micro usb cable ~~$5
 * either:
 * * rechargeable 5 volt battery pack (phone backup battery), this makes your project wireless ~~ $20, or
 * * usb wall adapter ~~$5
 * A WiFi connection

What you'll need access to for setup:

A monitor
A mouse and keyboard
A computer with an SD card slot
A Micro SD to SD card converter (should come with your micro SD card)

## Step 1: Setting Up Your Pi

*Now let's set up your Pi*

To begin, make sure you have all of the required items from the last step. Then, follow the steps on the Raspberry Pi website on installing Raspbian Jessie on your Microsd card, found here.

Once you have Raspbian installed on your Pi, it's time to get some basic features set up.

### WiFi

The first step to getting the most out of your Pi is to connect your it to the internet. You may have completed this step already either by locating the WiFi symbol in the upper right corner of your Pi's main screen and signing in there, or doing the same thing before installing Raspbian in the last step. If you are unable to sign in to your WiFi network from your Pi's desktop interface, you can follow the instructions here to set up WiFi through the command line.

### SSH

One very handy tool available to you when using your Pi is the option to issue commands to your Pi in what is known as a headless setup. By using a Secure SHell, or SSH, you can control your Pi remotely from a computer. With this method, all you will need to edit your Pi is a power source to keep it on, no more monitor and keyboard!

[!https://cdn.instructables.com/FJM/C0SI/J34PIUH1/FJMC0SIJ34PIUH1.MEDIUM.jpg]

## Step 2: SSHing Into Your PI

SSHing into your Raspberry Pi is easy and very useful, as the process allows you to issue commands to your Pi from any computer with nothing more than a WiFi connection.

To SSH into your Pi, you need to follow these 3 simple steps.

First, you need to enable SSH on your Pi. To do this, open up a command window in your Pi, and type in:

	sudo raspi-config

This command allows you to enter a configuration menu. from there you will want to use the arrow, tab, and enter keys to go first into interfacing options, then to enable SSH, as well as the camera, then exit and reboot the pi.

Next, you'll need to find your Pi's IP address. In a command terminal, type:

	sudo ifconfig

And your IP address should be in the wlan0 section that pops up, right under Link encap:ethernet. In the demo picture above, the IP Address is 192.168.1.10 .

Last, you'll need to either open up the built in terminal app on a mac, or find and follow instructions for a 3rd party ssh app for windows. In the Terminal app, type:

	ssh pi@YOUR IP ADDRESS

If you haven't changed the password while in Raspi-config, then your password to enter when prompted will be the default password: raspberry.

From there, you should be good to go!

## Step 3: Email Your IP Address on Boot

[!https://cdn.instructables.com/FLJ/2NMY/J34PIU13/FLJ2NMYJ34PIU13.MEDIUM.jpg "Picture of Email Your IP Address on Boot"]
In this step we will focus on how to access your Raspberry Pi, regardless of the network you are on. Depending on the network, the Pi's IP address changes. And if you do not have a monitor setup, you would need to ssh into the Pi to trigger the motion detection protocol, change motion preferences, or access anything else on the device. To solve this problem we will write a python script that emails us the Pi's IP current IP address upon start up. The python script is as follows and was stored in an directory marked "background".

	# start in home directory
	cd ~
	# create background folder
	mkdir background
	# create python script
	sudo nano emailip.py
	# write in emailip.py
	import socket
	s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
	s.connect(("8.8.8.8", 80))
	print(s.getsockname()[0])x = s.getsockname()[0]s.close()
	import smtplib
	from email.MIMEMultipart import MIMEMultipart
	from email.MIMEText import MIMEText
	fromaddr = "YOUR ADDRESS"
	toaddr = "RECEIVING ADDRESS"
	msg = MIMEMultipart()
	msg['From'] = fromaddr
	msg['To'] = toaddr
	msg['Subject'] = "IP Address"
	body = xmsg.attach(MIMEText(body, 'plain'))
	server = smtplib.SMTP('smtp.gmail.com', 587)
	server.starttls()
	server.login(fromaddr, "YOUR PASSWORD")
	text = msg.as_string()
	server.sendmail(fromaddr, toaddr, text)
	server.quit()
	
	# then this does it on reboot
	sudo nano /etc/rc.local
	
	# enter in /etc/rc.local
	while ! /sbin/ifconfig wlan0 | grep -q 'inet addr:[0-9]';
	do sleep 3
	done
	
	_IP=$(hostname -I) || true
	if [ "$_IP" ]; then
	printf "My IP address is %s\n" "$_IP"
	python /home/pi/Background/emailip.py &
	fi
	exit 0
	# and you're done

## Step 4: Installing and Setting Up Motion

	#update pi
	sudo apt-get update
	sudo apt-get upgrade

	#download
	sudo apt-get motion

	#now edit this file with the following changes
	sudo nano /etc/motion/motion.conf
	#to set a standard for this tutorial, change
	#################
	daemon on
	stream_localhost off
	webcontrol_localhost off
	ffmpeg_output_movies on
	target_dir /var/lib/motion

	##################
	#local web browser streaming options
	##################
	stream_maxrate 100 
	#This will allow for real-time streaming but requires more bandwidth & resources
	framerate 60 
	#This will allow for 60 frames to be captured per second #the higher this gets, the slower the video processing
	width 640 
	#This changes the width of the image displayed
	height 480 
	#This changes the height of the image displayed

	##################
	#emailing video settings in .../motion.conf
	##################
	#delete the " ; " in front of the line, the semicolon comments the line out
	on_event_start python /home/pi/background/motionalert.py %f
	on_movie_end python /home/pi/background/motionvid.py %f

	##################
	#astectics
	##################
	#choices described in the file
	output_pictures locate_motion_style
	##################
	#then change
	sudo nano /etc/default/motion
	#to say
	start_motion_daemon=yes
	#last, start the B**** up
	sudo service motion start
	#you can change the command to "stop", or "restart"

## Step 5: Emailing Videos From Motion on Detection

Email when motion is detected:

	#start at home
	dircd ~
	#create motion alert python script
	sudo nano /home/pi/background/motionalert.py
	#write
	import smtplib
	from datetime import datetime
	from email.MIMEMultipart import MIMEMultipart
	from email.MIMEText import MIMEText
	fromaddr = "YOURADDRESS"
	toaddr = "RECIEVINGADDRESS"
	msg = MIMEMultipart()
	msg['From'] = fromaddr
	msg['To'] = toaddr
	msg['Subject'] = "Motion Detected"
	body = 'A motion has been detected.\nTime: %s' % str(datetime.now())
	msg.attach(MIMEText(body, 'plain'))
	server = smtplib.SMTP('smtp.gmail.com', 587)
	server.starttls()
	server.login(fromaddr, "YOURPASSWORD")
	text = msg.as_string()
	server.sendmail(fromaddr, toaddr, text)
	server.quit()

Email Video of motion when video is saved:

	#start at home
	dircd ~
	#create motion video python script
	sudo nano /home/pi/background/motionvid.py
	import smtplib
	from email.MIMEMultipart import MIMEMultipart
	from email.MIMEText import MIMEText
	from email.MIMEBase import MIMEBase
	from email import encoders
	fromaddr = "YOUR EMAIL"
	toaddr = "EMAIL ADDRESS YOU SEND TO"
	msg = MIMEMultipart()
	msg['From'] = fromaddr
	msg['To'] = toaddr
	msg['Subject'] = "Motion Cam Activated"
	body = "Video of Motion Detected"
	msg.attach(MIMEText(body, 'plain'))
	import os
	rootpath = '/var/lib/motion'
	filelist = [os.path.join(rootpath, f) for f in os.listdir(rootpath)]
	filelist = [f for f in filelist if os.path.isfile(f)]
	newest = max(filelist, key=lambda x: os.stat(x).st_mtime)
	filename = newest
	import os
	rootpath = '/var/lib/motion'
	filelist = [os.path.join(rootpath, f) for f in os.listdir(rootpath)]
	filelist = [f for f in filelist if os.path.isfile(f)]
	newest = max(filelist, key=lambda x: os.stat(x).st_mtime)
	attachment = open(newest, "rb")
	part = MIMEBase('application', 'octet-stream')
	part.set_payload((attachment).read())
	encoders.encode_base64(part)
	part.add_header('Content-Disposition', "attachment; filename= %s" % filename)
	msg.attach(part)
	server = smtplib.SMTP('smtp.gmail.com', 587)
	server.starttls()
	server.login(fromaddr, "YOUR PASSWORD")
	text = msg.as_string()
	server.sendmail(fromaddr, toaddr, text)
	server.quit()

## Step 6: Troubleshooting and Sources

### Troubleshooting:

Because this project has multiple stages, there are several points at which things can go wrong. Below are some of the possible errors that could occur and how to fix them.

 * When setting up your pi to email you its current IP address, it is crucial to edit the rc.local file as shown earlier because this allows for a slight delay before the program activates after rebooting. Otherwise the pi will not yet be connected to wifi, and the email will not send.
 * When editing the motion.conf file make sure to delete the semicolons in front of certain parameters. The semicolon suppress a given action, so otherwise the change will not take effect.
 * The motion.conf file is very well organized and detailed. Feel free to change the settings to your liking, but understand they may effect the success of the motion capture system.
 * After setting up the email alert and email video options, it is important to note that the email of the motion detected video will take a little bit longer than to send than the initial alert email. This is because the video concludes a couple seconds after motion is no longer detected, and because the email attachment could be large enough to require a couple minutes to receive. In some cases, if motion is sustained for a very long amount of time it may be too large to send at all. Because of this it is always a good idea to check the livestream after receiving the initial alert email.

### Why Motion?:

When first embarking on this project we considered several different resources. First we considered using the PiCam which is a camera unit built specifically for the raspberry pi. The PiCam is certainly a capable device and has many applications, but it is limited to using programs that are specifically designed for it and is relatively expensive compared to cheap multipurpose webcams. So in order to make this project accessible for a larger audience, we decided to use a common USB webcam. The next issue was which software to incorporate. We initially considered OpenCV which is free software that allows for many different sorts of Computer Vision and imaging projects. On of the issues here is that OpenCV is a massive file that takes up a lot of memory and a long time set up. The setup also has multiple stages, leaving even more room for error. We found that for our specific project, Motion was simpler to setup and get working, but much more robust in its execution.