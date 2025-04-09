FROM rust:1.86

WORKDIR temp/

# $1 is string argument given to temp.sh
RUN echo "set -f && echo \$1 > tmp.rs && rustc -o rust-temp tmp.rs && timeout --kill-after 10s 7s ./rust-temp" > temp.sh

CMD bash temp.sh 'fn main() {println!("Hello, world!")}'