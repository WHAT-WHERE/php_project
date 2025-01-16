import mysql.connector
from mysql.connector import Error

def connect_to_mysql():
    try:
        # Connect to MySQL database
        connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='pritam099123',
            database='users'
        )

        if connection.is_connected():
            print('Connected to MySQL database')

            return connection

    except Error as e:
        print(f'Error connecting to MySQL database: {e}')

    return None

def insert_user(connection, name, contact, gender, username, password):
    try:
        # Create cursor object
        cursor = connection.cursor()

        # SQL query to insert user information
        sql = """INSERT INTO users_data (Name, Contact, Gender, Email, Password)
                 VALUES (%s, %s, %s, %s, %s)"""
        values = (name, contact, gender, username, password)

        # Execute the SQL query
        cursor.execute(sql, values)

        # Commit the transaction
        connection.commit()

        print('User information inserted successfully')

    except Error as e:
        print(f'Error inserting user information: {e}')

def main():
    # Connect to MySQL database
    connection = connect_to_mysql()

    if connection:
        # Get user input
        name = input('Enter name: ')
        contact = input('Enter phone number: ')
        gender = input('Enter gender (Male/Female/Other): ')
        username = input('Enter email: ')
        password = input('Enter password: ')

        # Insert user information into database
        insert_user(connection, name, contact, gender, username, password)

        # Close database connection
        connection.close()

if __name__ == "__main__":
    main()

