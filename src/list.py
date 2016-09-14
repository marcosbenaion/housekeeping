#! /usr/bin/python2

import json
import os
import sqlite3

home = os.getenv("HOME")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

c.execute('''SELECT * FROM aparelhos''')
devices = c.fetchall()

f = open(home + "/.housekeeping/devices.json", "w")

f.write(json.dumps(devices))

f.close()

conn.close()
