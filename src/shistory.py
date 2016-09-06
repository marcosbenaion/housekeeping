#! /usr/bin/python2

import json
import os
import sqlite3

home = os.getenv("HOME")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

c.execute('''SELECT * FROM historico''')
records = c.fetchall()
print records
f = open(home + "/.housekeeping/historico.json", "w")

f.write(json.dumps(records))

f.close()

conn.close()
