import sqlite3

def create_db():
    conn = sqlite3.connect(':memory:')  # Use in-memory database for demo
    cursor = conn.cursor()
    cursor.execute('''
        CREATE TABLE users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL,
            password TEXT NOT NULL
        )
    ''')
    # Insert sample users
    cursor.execute("INSERT INTO users (username, password) VALUES ('admin', 'admin123')")
    cursor.execute("INSERT INTO users (username, password) VALUES ('user', 'userpass')")
    conn.commit()
    return conn

def vulnerable_login(conn, username, password):
    cursor = conn.cursor()
    # Vulnerable query: direct string concatenation (Do NOT do this in real apps)
    query = f"SELECT * FROM users WHERE username = '{username}' AND password = '{password}'"
    print(f"Running query: {query}")
    cursor.execute(query)
    result = cursor.fetchone()
    if result:
        return True
    else:
        return False

def safe_login(conn, username, password):
    cursor = conn.cursor()
    # Safe query using parameters to prevent SQL injection
    query = "SELECT * FROM users WHERE username = ? AND password = ?"
    cursor.execute(query, (username, password))
    result = cursor.fetchone()
    if result:
        return True
    else:
        return False

def main():
    print("Demonstrasi SQL Injection dengan Python dan SQLite\n")
    conn = create_db()

    print("Login menggunakan metode rentan (vulnerable):")
    username = input("Masukkan username: ")
    password = input("Masukkan password: ")

    if vulnerable_login(conn, username, password):
        print("Login berhasil! (menggunakan query rentan)")
    else:
        print("Login gagal! (menggunakan query rentan)")

    print("\nLogin menggunakan metode aman (safe):")
    username = input("Masukkan username: ")
    password = input("Masukkan password: ")

    if safe_login(conn, username, password):
        print("Login berhasil! (menggunakan query aman)")
    else:
        print("Login gagal! (menggunakan query aman)")

    print("""
Penjelasan SQL Injection (Bahasa Indonesia):

SQL Injection adalah teknik peretasan keamanan aplikasi web yang mengeksploitasi kerentanan pada 
query database yang dibuat secara dinamis dan tidak aman, biasanya dengan menyisipkan perintah SQL 
berbahaya ke dalam input pengguna. Jika input pengguna disisipkan langsung ke dalam query tanpa 
pemeriksaan atau parameterisasi yang tepat, penyerang dapat mengubah logika query dan mengakses data 
yang tidak seharusnya, atau bahkan mengubah atau menghapus data.

Contoh pada program ini:
- Fungsi vulnerable_login menggunakan query yang menyisipkan username dan password secara langsung.
- Seorang penyerang bisa memasukkan password sebagai sesuatu seperti: ' OR '1'='1
  sehingga query menjadi:
  SELECT * FROM users WHERE username = 'admin' AND password = '' OR '1'='1'
  Ini akan selalu bernilai true dan memungkinkan akses tanpa password yang benar.

Solusi:
- Gunakan parameterized query (prepared statements) seperti pada fungsi safe_login agar input 
  tidak diinterpretasikan sebagai kode SQL.

Selalu validasi dan sanitasi input pengguna untuk mencegah SQL Injection.

    """)

if __name__ == '__main__':
    main()
