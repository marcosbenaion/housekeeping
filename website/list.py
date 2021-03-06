#! /usr/bin/python2

import json
import sqlite3

home = "/home/pi"
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

c.execute('''SELECT * FROM aparelhos''')
devices = c.fetchall()

f = open("/var/www/html/housekeeping/website/devices.json", "w")

f.write("{\n")
f.write("\"aparelhos\": [\n")

for i in range(len(devices)):
        f.write("\t{")
        f.write("\"nome\":" + "\"" + str(devices[i][0]) +"\", ")
        f.write("\"kwh\":" + str(devices[i][1]) + ", ")
        f.write("\"custo\":" + str(devices[i][2]) + ", ")
        f.write("\"estado\":" + str(devices[i][3]))
        f.write("}")
        if i < (len(devices) -1):
                f.write(",\n")


f.write("\n\t]\n}\n")

f.close()
conn.close()
