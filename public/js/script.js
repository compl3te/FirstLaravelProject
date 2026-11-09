document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('ipForm');
    const container = document.getElementById('result');
    const ipInput = document.getElementById('ip');

    if (!form || !container || !ipInput) {
        console.error('Не найдены элементы формы. Проверьте HTML.');
        return;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const ipValue = ipInput.value.trim();

        if (!ipValue) {
            container.innerHTML = '<p style="color: red;">Пожалуйста, введите IP-адрес.</p>';
            return;
        }

        if (ipValue.toLowerCase().startsWith('http')) {
            container.innerHTML = '<p style="color: red;">Введите только IP-адрес в формате 8.8.8.8</p>';
            return;
        }
        container.innerHTML = '<p>Загрузка данных...</p>';

        try {
            const response = await fetch(`/checkIp/${encodeURIComponent(ipValue)}`, {
                headers: {
                    'Accept': 'application/json'
                }
            }
            );
            
            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || `Ошибка сервера: ${response.status}`);
            }

            const ipInfo = await response.json();
            console.log("Ответ от сервера:", ipInfo);

            if (!ipInfo || !ipInfo.ip) {
                container.innerHTML = '<p style="color: red;">Информация об IP-адресе не найдена</p>';
                return;        
            }

            const html = `
                <p>IP: ${ipInfo.ip}</p>
                <p>Страна: ${ipInfo.country || 'Не указано'}</p>
                <p>Организация: ${ipInfo.organization || 'Не указано'}</p>
                <p>Регистрационные данные: ${ipInfo.netname || 'Не указано'}</p>
                <p>Диапазон: ${ipInfo.ip_range || 'Не указано'}</p>`;
            
            container.innerHTML = html;

        } catch (error) {
            container.innerHTML = `<p style='color: red;'>Ошибка: ${error.message}</p>`;
            console.error('Ошибка при проверке IP:', error);
        }
    });
});