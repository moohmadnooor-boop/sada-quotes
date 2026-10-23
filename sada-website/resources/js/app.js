const $ = (selector, root = document) => root.querySelector(selector);
const $$ = (selector, root = document) => [...root.querySelectorAll(selector)];

// This site uses the night theme only; clear the retired theme preference.
document.body.classList.remove('light-theme');
localStorage.removeItem('sada-theme-v2');

if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    $$('video[autoplay]').forEach((video) => { video.pause(); video.removeAttribute('autoplay'); });
}

const openDialog = (selector) => { const dialog = $(selector); if (dialog && !dialog.open) dialog.showModal(); };
$$('[data-open-quote]').forEach((button) => button.addEventListener('click', () => openDialog('#quote-dialog')));
$$('[data-open-challenge]').forEach((button) => button.addEventListener('click', () => {
    const challenge = $('#quote-dialog');
    if (!challenge) return;
    const checkbox = $('input[name="challenge"]', challenge);
    if (checkbox) checkbox.checked = true;
    challenge.showModal();
}));
$$('[data-close-dialog]').forEach((button) => button.addEventListener('click', () => button.closest('dialog')?.close()));
$$('[data-open-profile-edit]').forEach((button) => button.addEventListener('click', () => openDialog('#profile-dialog')));

// Small pointer tilt makes quote cards respond to hover; keyboard users get the same layout without motion.
if (window.matchMedia('(hover: hover) and (pointer: fine)').matches && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    $$('[data-quote-card]').forEach((card) => {
        card.addEventListener('pointermove', (event) => {
            const bounds = card.getBoundingClientRect();
            const x = (event.clientX - bounds.left) / bounds.width - .5;
            const y = (event.clientY - bounds.top) / bounds.height - .5;
            card.style.transform = `translateY(-4px) rotateX(${y * -2}deg) rotateY(${x * 2}deg)`;
        });
        card.addEventListener('pointerleave', () => { card.style.removeProperty('transform'); });
    });
    const hero = $('[data-parallax]');
    hero?.addEventListener('pointermove', (event) => {
        const bounds = hero.getBoundingClientRect();
        hero.style.setProperty('--pointer-x', `${(event.clientX - bounds.left) / bounds.width * 100}%`);
        hero.style.setProperty('--pointer-y', `${(event.clientY - bounds.top) / bounds.height * 100}%`);
    });
}

async function shareText(text, url = location.href) {
    if (navigator.share) {
        try { await navigator.share({ title: 'صدى', text, url }); return; } catch (error) { if (error.name === 'AbortError') return; }
    }
    try {
        await navigator.clipboard.writeText(`${text}\n${url}`);
        alert('تم نسخ الاقتباس والرابط.');
    } catch { alert('تعذرت المشاركة تلقائيًا. انسخ الرابط من شريط المتصفح.'); }
}

$$('[data-share-quote]').forEach((button) => button.addEventListener('click', () => {
    const card = button.closest('[data-quote-card]');
    shareText(card?.dataset.content || '', card?.dataset.url || location.href);
}));
$$('[data-share-featured]').forEach((button) => button.addEventListener('click', () => shareText(button.dataset.shareFeatured || '', location.href)));
$$('[data-copy-link]').forEach((button) => button.addEventListener('click', async () => {
    const card = button.closest('[data-quote-card]');
    try { await navigator.clipboard.writeText(card?.dataset.url || location.href); button.textContent = 'تم النسخ ✓'; }
    catch { await shareText(card?.dataset.content || '', card?.dataset.url || location.href); }
}));

$$('[data-card-quote]').forEach((button) => button.addEventListener('click', () => {
    const card = button.closest('[data-quote-card]');
    $('#card-preview-text').textContent = `“${card?.dataset.content || ''}”`;
    $('#card-preview-author').textContent = `— ${card?.dataset.author || ''}`;
    openDialog('#card-dialog');
}));
$('#card-theme')?.addEventListener('change', (event) => $('#card-preview')?.setAttribute('data-theme', event.target.value));

function wrapText(ctx, text, maxWidth) {
    const words = text.split(/\s+/);
    const lines = [];
    let line = '';
    for (const word of words) {
        const next = line ? `${line} ${word}` : word;
        if (ctx.measureText(next).width > maxWidth && line) { lines.push(line); line = word; }
        else line = next;
    }
    if (line) lines.push(line);
    return lines;
}

$('#download-card')?.addEventListener('click', () => {
    const text = $('#card-preview-text')?.textContent || '';
    const author = $('#card-preview-author')?.textContent || '';
    const theme = $('#card-preview')?.dataset.theme || 'violet';
    const palettes = {
        violet: ['#634a91', '#21192f', '#f5bd74'], sunset: ['#a75459', '#351d37', '#ffd0a3'],
        mint: ['#34796e', '#1c2c3a', '#b8f0d5'], sand: ['#a18155', '#493942', '#fff0cf'],
    };
    const [start, end, accent] = palettes[theme];
    const canvas = document.createElement('canvas');
    canvas.width = 1200; canvas.height = 630;
    const ctx = canvas.getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 1200, 630);
    gradient.addColorStop(0, start); gradient.addColorStop(1, end);
    ctx.fillStyle = gradient; ctx.fillRect(0, 0, 1200, 630);
    ctx.strokeStyle = 'rgba(255,255,255,.18)'; ctx.lineWidth = 2; ctx.strokeRect(34, 34, 1132, 562);
    ctx.fillStyle = accent; ctx.font = 'bold 32px Arial'; ctx.textAlign = 'right'; ctx.direction = 'rtl'; ctx.fillText('صدى  ✦', 1080, 100);
    ctx.fillStyle = '#fff'; ctx.font = 'bold 46px Arial';
    const lines = wrapText(ctx, text, 980);
    const lineHeight = 72;
    let y = Math.max(270 - ((lines.length - 1) * lineHeight) / 2, 170);
    for (const line of lines.slice(0, 5)) { ctx.fillText(line, 1080, y, 980); y += lineHeight; }
    ctx.fillStyle = 'rgba(255,255,255,.68)'; ctx.font = '28px Arial'; ctx.fillText(author, 1080, Math.min(y + 34, 530));
    ctx.fillStyle = accent; ctx.font = '22px Arial'; ctx.textAlign = 'left'; ctx.fillText('كلمات تبقى في الأثر', 120, 550);
    canvas.toBlob((blob) => {
        if (!blob) return;
        const link = document.createElement('a'); link.download = 'quoteit-card.png'; link.href = URL.createObjectURL(blob); link.click();
        setTimeout(() => URL.revokeObjectURL(link.href), 1000);
    }, 'image/png');
});
