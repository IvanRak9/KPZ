
class FileWriterAdapter:
    def __init__(self, file_writer):
        self.file_writer = file_writer

    def Log(self, message):
        self.file_writer.Write(message + '\n')

    def Error(self, message):
        self.file_writer.Write('ERROR: ' + message + '\n')

    def Warn(self, message):
        self.file_writer.Write('WARNING: ' + message + '\n')


class FileWriter:
    def Write(self, message):
        with open('log.txt', 'a') as file:
            file.write(message)

    def WriteLine(self, message):
        with open('log.txt', 'a') as file:
            file.write(message + '\n')


class Logger:
    def Log(self, message):
        print('\033[92m' + message + '\033[0m')

    def Error(self, message):
        print('\033[91m' + message + '\033[0m')

    def Warn(self, message):
        print('\033[93m' + message + '\033[0m')


def main():
    file_writer = FileWriter()

    adapter = FileWriterAdapter(file_writer)

    adapter.Log('This is a log message.')
    adapter.Error('This is an error message.')
    adapter.Warn('This is a warning message.')


if __name__ == "__main__":
    main()
