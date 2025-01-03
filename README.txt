# Mattress Direct

Welcome to Mattress Direct! This project is a web application for browsing and purchasing mattresses online.

## Features

- Browse a wide selection of mattresses
- Filter mattresses by size, type, and price
- View detailed information about each mattress
- Add mattresses to your shopping cart
- Secure checkout process

## Installation

1. Clone the repository:
    ```
    git clone https://github.com/yourusername/mattressdirect.git
    ```
2. Navigate to the project directory:
    ```
    cd mattressdirect
    ```
3. Install dependencies:
    ```
    composer install
    ```

## Usage


1. Open your web browser and go to `http://localhost:3000`.

## Contributing

We welcome contributions! Please read our [contributing guidelines](CONTRIBUTING.md) for more information.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.


[2:40 PM, 12/30/2024] +234 906 007 9411: The yellow

#DCDC00
[2:41 PM, 12/30/2024] +234 906 007 9411: The Blue

#04048C



 if (data.status === true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Login successful',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    background: '#04048C',
                    color: '#DCDC00'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'index.php'; // Redirect only after viewing response
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    background: '#f8d7da',
                    color: '#721c24'
                });
            }