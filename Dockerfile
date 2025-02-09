FROM rust:1.67

WORKDIR temp/

# $1 is string argument given to temp.sh
RUN echo "echo \$1 > tmp.rs && rustc -o rust-temp tmp.rs && ./rust-temp" > temp.sh

CMD bash temp.sh 'fn main() {println!("Hello, world!")}'