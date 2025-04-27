import re

class SmartTextReader:
    def __init__(self, filename):
        self.filename = filename

    def read_text(self):
        with open(self.filename, 'r') as file:
            return [list(line.strip()) for line in file]


class SmartTextCheckerProxy(SmartTextReader):
    def read_text(self):
        print(f"Opening file: {self.filename}")
        content = super().read_text()
        print(f"Reading file: {self.filename}")
        num_lines = len(content)
        num_chars = sum(len(line) for line in content)
        print(f"Total lines: {num_lines}, Total characters: {num_chars}")
        print(f"Closing file: {self.filename}")
        return content


class SmartTextReaderLockerProxy(SmartTextReader):
    def __init__(self, filename, restricted_pattern):
        super().__init__(filename)
        self.restricted_pattern = restricted_pattern

    def read_text(self):
        if re.match(self.restricted_pattern, self.filename):
            print("Access denied!")
            return []
        else:
            return super().read_text()


def main():
    print("SmartTextCheckerProxy:")
    text_checker = SmartTextCheckerProxy("example.txt")
    content = text_checker.read_text()
    for line in content:
        print("".join(line))

    print("\nSmartTextReaderLockerProxy:")
    restricted_file = SmartTextReaderLockerProxy("restricted.txt", r"restricted.*")
    content = restricted_file.read_text()
    for line in content:
        print("".join(line))


if __name__ == "__main__":
    main()
