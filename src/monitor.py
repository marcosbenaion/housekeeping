#! /usr/bin/python2

import os
import sqlite3
import time

cost = 0.30
total = 0
t_time = 0

home = os.getenv("HOME")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

c.execute('''select estado from aparelhos where nome="tv"''')
status = c.fetchone()[0]

start_time = time.time()
interval = 1
i = 1
while status != 0:
    time.sleep(start_time + i*interval - time.time())
    total += cost
    c.execute('''select estado from aparelhos where nome="tv"''')
    status = c.fetchone()[0]
    t_time += 1
    i+=1
    if (t_time % 60) == 0:
        t = (total,)
        c.execute('''update aparelhos set valor=? where nome="tv"''', t)
        conn.commit()

t = (total,)
c.execute('''update aparelhos set valor=? where nome="tv"''', t)
conn.commit()
conn.close()
