import axios from "axios";
import cheerio from "cheerio";

export default async function handler(req, res) {
  const { username } = req.query;

  if (!username) {
    return res.status(400).json({ error: "Username required" });
  }

  try {
    const url = `https://www.tiktok.com/@${username}`;
    const { data } = await axios.get(url, {
      headers: {
        "User-Agent": "Mozilla/5.0"
      }
    });

    const $ = cheerio.load(data);
    const scriptTag = $('script[id="__NEXT_DATA__"]').html();
    const jsonData = JSON.parse(scriptTag);
    const userInfo = jsonData.props.pageProps.userInfo.user;

    const result = {
      name: userInfo.nickname,
      username: userInfo.uniqueId,
      avatar: userInfo.avatarLarger,
      followers: userInfo.stats.followerCount,
      following: userInfo.stats.followingCount,
      likes: userInfo.stats.heartCount
    };

    res.status(200).json(result);
  } catch (error) {
    res.status(500).json({ error: "Failed to fetch data" });
  }
}
