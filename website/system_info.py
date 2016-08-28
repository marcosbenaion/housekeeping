#!/usr/bin/python
# -*- coding: utf-8 -*-

import subprocess
import os
import MySQLdb as mdb

# Function for storing readings into MySQL
def insertDB(system_load, ram, disk, temperature):

  try:
    con = mdb.connect('localhost',
                      'pi_insert',
                      '123456',
                      'measurements');
    cursor = con.cursor()

    sql = "INSERT INTO system_info(`load`,`ram`,`disk`,`temperature`) \
    VALUES ('%s', '%s', '%s', '%s')" % \
    (system_load, ram, disk, temperature)
    cursor.execute(sql)
    con.commit()

    con.close()

  except mdb.Error, e:
    con.rollback()
    print "Error %d: %s" % (e.args[0],e.args[1])
    sys.exit(1)

# returns the system load over the past minute
def get_load():
    try:
        s = subprocess.check_output(["cat","/proc/loadavg"])
        return float(s.split()[0])
    except:
        return 0

# Returns the used ram as a percentage of the total available
def get_ram():
    try:
        s = subprocess.check_output(["free","-m"])
        lines = s.split("\n")
        used_mem = float(lines[1].split()[2])
        total_mem = float(lines[1].split()[1])
        return (int((used_mem/total_mem)*100))
    except:
        return 0

# Returns the percentage used disk space on the /dev/root partition
def get_disk():
    try:
        s = subprocess.check_output(["df","/dev/root"])
        lines = s.split("\n")
        return int(lines[1].split("%")[0].split()[4])
    except:
        return 0

# Returns the temperature in degrees C of the CPU
def get_temperature():
    try:
        dir_path="/opt/vc/bin/vcgencmd"
        s = subprocess.check_output([dir_path,"measure_temp"])
        return float(s.split("=")[1][:-3])
    except:
        return 0

got_load = str(get_load())
got_ram = str(get_ram())
got_disk = str(get_disk())
got_temperature = str(get_temperature())

insertDB(got_load, got_ram, got_disk, got_temperature)
