#! /usr/bin/python2

import datetime
import os
import sqlite3
import sys
import time

total = 0
t_time = 0
device = (sys.argv[1],)

home = os.getenv("HOME")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

c.execute('''select kwh from aparelhos where nome=?''', device)
kwh = c.fetchone()[0]
cost = kwh * 0.55 / 3600.0
c.execute('''select estado from aparelhos where nome=?''', device)
status = c.fetchone()[0]

start_time = time.time()
interval = 1
i = 1
while status != 0:
    time.sleep(start_time + i*interval - time.time())
    total += cost
    c.execute('''select estado from aparelhos where nome=?''', device)
    status = c.fetchone()[0]
    t_time += 1
    i+=1
    if (t_time % 60) == 0:
        t = (total, sys.argv[1])
        c.execute('''update aparelhos set valor=? where nome=?''', t)
        conn.commit()

t = (total, sys.argv[1])
c.execute('''update aparelhos set valor=? where nome=?''', t)
t = (sys.argv[1], datetime.datetime.now().month, total)
c.execute('''INSERT INTO historico VALUES(?, ?, ?)''', t)
conn.commit()
conn.close()
