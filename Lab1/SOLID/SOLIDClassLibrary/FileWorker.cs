using System.Text;

namespace SOLIDClassLibrary.FileWorker
{
    // The first SOLID principle (Single Responsibility Principle)
    // We did decomposition: created individual classes for things that are independent and don't relate from other classes
    public class FileWorker
    {
        private readonly string _file;

        public FileWorker(string file)
        {
            _file = file;
        }

        public void Write(string content)
        {
            File.WriteAllText(_file, content, Encoding.UTF8);
        }
        
        public void Append(string content)
        {
            File.AppendAllText(_file, content, Encoding.UTF8);
        }
        
        public void Clear()
        {
            File.WriteAllText(_file,string.Empty, Encoding.UTF8);
        }
    }
}