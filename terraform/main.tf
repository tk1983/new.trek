# 変数の設定
variable "aws_access_key" {}
variable "aws_secret_key" {}

# Terraform のバージョン指定
terraform {
  required_version = "= 0.13.4"
}

# 変数を利用した provider の設定
provider "aws" {
    version = "= 2.18.0"
    access_key = "${var.aws_access_key}"
    secret_key = "${var.aws_secret_key}"
    region = "ap-northeast-1"
}

# VPC の作成
resource "aws_vpc" "vpc" {
  cidr_block           = "10.10.0.0/16"
  instance_tenancy     = "default"
  enable_dns_support   = "true"
  enable_dns_hostnames = "false"
  tags = {
    Name = "main_vpc"
  }
}