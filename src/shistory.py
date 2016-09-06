#! /usr/bin/python2

import os
import sqlite3

home = os.getenv("HOME")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

c.execute('''SELECT * FROM historico''')
records = c.fetchall()

conn.close()
