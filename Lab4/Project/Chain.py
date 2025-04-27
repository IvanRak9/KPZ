class SupportHandler:
    def __init__(self, next_handler=None):
        self.next_handler = next_handler

    def handle_request(self, request):
        if self.next_handler:
            return self.next_handler.handle_request(request)
        else:
            return "No appropriate handler found."


class Level1SupportHandler(SupportHandler):
    def handle_request(self, request):
        if request == "simple":
            return "Handled by Level 1 support."
        else:
            return super().handle_request(request)


class Level2SupportHandler(SupportHandler):
    def handle_request(self, request):
        if request == "complex":
            return "Handled by Level 2 support."
        else:
            return super().handle_request(request)


class Level3SupportHandler(SupportHandler):
    def handle_request(self, request):
        if request == "critical":
            return "Handled by Level 3 support."
        else:
            return super().handle_request(request)


class Level4SupportHandler(SupportHandler):
    def handle_request(self, request):
        if request == "emergency":
            return "Handled by Level 4 support."
        else:
            return super().handle_request(request)
def main():
    level4 = Level4SupportHandler()
    level3 = Level3SupportHandler(level4)
    level2 = Level2SupportHandler(level3)
    level1 = Level1SupportHandler(level2)

    while True:
        request = input("Enter your request ('simple', 'complex', 'critical', 'emergency'): ")
        result = level1.handle_request(request)
        print(result)
        if result != "No appropriate handler found.":
            break


if __name__ == "__main__":
    main()
