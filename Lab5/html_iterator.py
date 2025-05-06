from collections import deque

class HTMLElement:
    def __init__(self, tag_name):
        self.tag_name = tag_name
        self.children = []

    def add_child(self, child):
        self.children.append(child)

    def __str__(self):
        return f"<{self.tag_name}>"

class DFSIterator:
    def __init__(self, root):
        self.stack = [root]

    def __iter__(self):
        return self

    def __next__(self):
        if not self.stack:
            raise StopIteration
        current = self.stack.pop()
        self.stack.extend(reversed(current.children))
        return current

class BFSIterator:
    def __init__(self, root):
        self.queue = deque([root])

    def __iter__(self):
        return self

    def __next__(self):
        if not self.queue:
            raise StopIteration
        current = self.queue.popleft()
        self.queue.extend(current.children)
        return current

def main():
    root = HTMLElement("html")
    head = HTMLElement("head")
    body = HTMLElement("body")
    div = HTMLElement("div")
    span = HTMLElement("span")

    root.add_child(head)
    root.add_child(body)
    body.add_child(div)
    div.add_child(span)

    print("DFS:")
    for el in DFSIterator(root):
        print(el)

    print("\nBFS:")
    for el in BFSIterator(root):
        print(el)

if __name__ == "__main__":
    main()
