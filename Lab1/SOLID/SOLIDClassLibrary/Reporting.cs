namespace SOLIDClassLibrary.Reporting
{
    public class Reporting : IReporting
    {
        private readonly Action<string> _reportingHandler;
        public Reporting(Action<string> reportingHandler)
        {
            _reportingHandler = reportingHandler;
        }
        public void Added()
        {
            _reportingHandler.Invoke("Товар додано" + Environment.NewLine);
        }
        public void Removed()
        {
            _reportingHandler.Invoke("Товар видалено" + Environment.NewLine);
        }
        public void Left(int count)
        {
            _reportingHandler.Invoke($"{count} одиниць продукції доступно зараз" + Environment.NewLine);
        }
    }
}