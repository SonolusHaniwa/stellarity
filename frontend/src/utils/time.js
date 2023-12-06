// format = 'mm:ss' | 'HH:mm:ss'
export function formatSeconds(seconds, format = 'mm:ss') {
    const date = new Date(0);
    date.setSeconds(seconds); // specify value for SECONDS here
    const start = format === 'mm:ss' ? 14 : 11;
    const end = 19;
    return date.toISOString().substring(start, end);
}

export function sleep(ms) {
    return new Promise((resolve) => {
        setTimeout(resolve, ms);
    });
}