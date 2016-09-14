#! /usr/bin/python2

import json
import sqlite3

home = "/home/pi"
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

c.execute('''SELECT * FROM historico''')
records = c.fetchall()

f = open("/var/www/html/housekeeping/website/historico.json", "w")

f.write("{\n")
f.write("\"historico\": [\n")

for i in range(len(records)):
        f.write("\t{")
        f.write("\"nome\":" + "\"" + str(records[i][0]) +"\", ")
        f.write("\"mes\":" + str(records[i][1]) + ", ")
        f.write("\"custo\":" + str(records[i][2]))
        f.write("}")
        if i < (len(records) -1):
                f.write(",\n")


f.write("\n\t]\n}\n")

f.close()

conn.close()
